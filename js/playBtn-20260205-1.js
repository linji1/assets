// 听读功能核心JS（放在 </body> 前）
(function () {
  const speechSynthesis = window.speechSynthesis;
  let voices = [];
  let currentUtterance = null;
  let currentSentenceIndex = 0;
  let isPlaying = false;
  let sentences = [];
  const rate = 1;

  // 新增：用于保存选中的 Range
  let savedSelectionRange = null;

  // 判断是否为 PC 端
  const isPC = !/Mobile|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

  // 移动端用户手势标记
  let hasUserGesture = false;
  const recordGesture = () => { 
    hasUserGesture = true; 
    enableControls(); // 手势后启用控件
  };
  if (!isPC) {
    document.body.addEventListener('click', recordGesture, { once: true });
    document.body.addEventListener('touchstart', recordGesture, { once: true });
  } else {
    hasUserGesture = true; // PC 默认允许
  }

  // 启用播放等控件
  function enableControls() {
    const playBtn = document.getElementById('playBtn');
    if (playBtn) playBtn.disabled = false;
  }

  // 禁用控件（如语音未加载完）
  function disableControls() {
    const playBtn = document.getElementById('playBtn');
    if (playBtn) playBtn.disabled = true;
  }

  // 安全包裹句子：仅处理文本节点，跳过 script/style/noscript，保留 img/a 等结构
  function createSentenceElements(element) {
    const walker = document.createTreeWalker(
      element,
      NodeFilter.SHOW_TEXT,
      {
        acceptNode: function (node) {
          const parent = node.parentElement;
          if (parent && ['SCRIPT', 'STYLE', 'NOSCRIPT', 'TEXTAREA', 'CODE'].includes(parent.tagName)) {
            return NodeFilter.FILTER_REJECT;
          }
          if (parent && parent.closest && parent.closest('.sentence')) {
            return NodeFilter.FILTER_REJECT;
          }
          return node.textContent.trim() ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_REJECT;
        }
      },
      false
    );

    const textNodes = [];
    let node;
    while ((node = walker.nextNode())) {
      textNodes.push(node);
    }

    for (let i = textNodes.length - 1; i >= 0; i--) {
      const textNode = textNodes[i];
      const text = textNode.nodeValue;
      const parent = textNode.parentNode;

      const parts = text.split(/(?<=[。！？!?])/).filter(p => p.trim());
      if (parts.length === 0) continue;

      const fragment = document.createDocumentFragment();
      parts.forEach(part => {
        const span = document.createElement('span');
        span.className = 'sentence';
        span.textContent = part;
        fragment.appendChild(span);
      });

      parent.replaceChild(fragment, textNode);
    }
  }

  function initReading() {
    const printview = document.getElementById('printview');
    if (!printview) {
      console.warn('#printview not found');
      return;
    }

    createSentenceElements(printview);
    sentences = Array.from(printview.querySelectorAll('.sentence'));

    disableControls();

    waitForVoices().then(() => {
      setupEventListeners();
      bindSelectReadEvent();
      updateProgress();
      enableControls();
    });
  }

  function waitForVoices() {
    return new Promise((resolve) => {
      const loadVoices = () => {
        voices = speechSynthesis.getVoices();
        if (voices.length > 0) {
          initVoiceSelect();
          resolve();
        } else {
          setTimeout(loadVoices, 100);
        }
      };
      loadVoices();
      speechSynthesis.onvoiceschanged = loadVoices;
    });
  }

  function initVoiceSelect() {
    const voiceSelect = document.getElementById('voiceSelect');
    if (!voiceSelect) return;

    voiceSelect.innerHTML = voices.map((v, i) =>
      `<option value="${i}">${v.name} (${v.lang})</option>`
    ).join('');

    const preferred = voices.findIndex(v =>
      v.lang === 'zh-CN' || v.lang.startsWith('zh') || v.lang.includes('cmn')
    );
    voiceSelect.value = preferred !== -1 ? preferred : (voices.length > 0 ? 0 : '');
  }

  function setupEventListeners() {
    sentences = Array.from(document.querySelectorAll('#printview .sentence'));
    sentences.forEach((s, i) =>
      s.addEventListener('click', (e) => {
        if (!e.target.closest('a')) {
          handleClickSentence(i);
        }
      })
    );

    document.addEventListener('click', (e) => {
      if (e.target.id === 'playBtn') {
        handlePlayAction();
      }
    });
  }

  function bindSelectReadEvent() {
    const handler = () => {
      const selection = window.getSelection?.();
      if (!selection || selection.isCollapsed) return;

      const selectedText = selection.toString().trim();
      if (!selectedText) return;

      if (isPC || hasUserGesture) {
        readSelectedText(selectedText);
        // ⚠️ 不再这里清除选区！由朗读结束时恢复
      } else {
        alert('请先点击页面任意位置，再使用选中朗读功能。');
      }
    };

    document.addEventListener('mouseup', handler);
    if (!isPC) document.addEventListener('touchend', handler);
  }

  // 新增：恢复之前保存的选区
  function restoreSavedSelection() {
    if (savedSelectionRange) {
      const selection = window.getSelection();
      try {
        selection.removeAllRanges();
        selection.addRange(savedSelectionRange);
      } catch (e) {
        console.warn('无法恢复选区，可能 DOM 已变更:', e);
      }
      savedSelectionRange = null;
    }
  }

  function readSelectedText(text) {
    if (!hasUserGesture && !isPC) return;

    // 保存当前选区
    const selection = window.getSelection();
    if (selection.rangeCount > 0) {
      savedSelectionRange = selection.getRangeAt(0).cloneRange();
    } else {
      savedSelectionRange = null;
    }

    speechSynthesis.cancel();
    isPlaying = false;
    removeReadingStyles();
    updateButtonStates();
    updateProgress();

    const voiceSelect = document.getElementById('voiceSelect');
    const selectedVoiceIndex = voiceSelect && !isNaN(voiceSelect.value)
      ? parseInt(voiceSelect.value, 10)
      : 0;

    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'zh-CN';
    if (voices[selectedVoiceIndex]) utterance.voice = voices[selectedVoiceIndex];
    utterance.rate = rate;

    // 朗读结束或出错时恢复选区
    utterance.onend = () => {
      restoreSavedSelection();
    };
    utterance.onerror = (e) => {
      console.error('朗读出错:', e);
      restoreSavedSelection();
    };

    currentUtterance = utterance;
    speechSynthesis.speak(utterance);
  }

  function handlePlayAction() {
    if (!isPC && !hasUserGesture) {
      alert('请先点击页面任意位置，再使用朗读功能。');
      return;
    }

    if (sentences.length === 0) {
      console.warn('无可朗读内容');
      return;
    }

    speechSynthesis.cancel();
    removeReadingStyles();
    currentSentenceIndex = 0;
    isPlaying = true;
    speakFromCurrentIndex();
    updateButtonStates();
  }

  function handleClickSentence(index) {
    if (!isPC && !hasUserGesture) {
      alert('请先点击页面任意位置，再使用朗读功能。');
      return;
    }

    if (sentences.length === 0) return;

    speechSynthesis.cancel();
    currentSentenceIndex = index;
    isPlaying = true;
    removeReadingStyles();
    speakFromCurrentIndex();
    updateButtonStates();
  }

  function speakFromCurrentIndex() {
    if (currentSentenceIndex < sentences.length) {
      speakSentence(currentSentenceIndex);
    }
  }

  function speakSentence(index) {
    if (index >= sentences.length) {
      isPlaying = false;
      updateButtonStates();
      updateProgress();
      return;
    }

    speechSynthesis.cancel();
    currentSentenceIndex = index;
    updateHighlight(index);

    const voiceSelect = document.getElementById('voiceSelect');
    const selectedVoiceIndex = voiceSelect && !isNaN(voiceSelect.value)
      ? parseInt(voiceSelect.value, 10)
      : 0;

    const utterance = new SpeechSynthesisUtterance(sentences[index].textContent.trim());
    if (voices[selectedVoiceIndex]) utterance.voice = voices[selectedVoiceIndex];
    utterance.rate = rate;
    utterance.lang = 'zh-CN';

    utterance.onstart = () => {
      sentences[index].classList.add('current');
      updateButtonStates();
      updateProgress();
      sentences[index].scrollIntoView({ behavior: 'smooth', block: 'center' });
    };

    utterance.onend = () => {
      sentences[index].classList.remove('current');
      currentSentenceIndex++;
      if (currentSentenceIndex < sentences.length) {
        speakSentence(currentSentenceIndex);
      } else {
        isPlaying = false;
        updateButtonStates();
        updateProgress();
      }
    };

    utterance.onerror = (e) => {
      console.error('朗读出错:', e);
      isPlaying = false;
      updateButtonStates();
    };

    currentUtterance = utterance;
    speechSynthesis.speak(utterance);
  }

  function removeReadingStyles() {
    sentences.forEach(s => s.classList.remove('current'));
  }

  function updateHighlight(index) {
    removeReadingStyles();
    if (sentences[index]) sentences[index].classList.add('current');
  }

  function updateButtonStates() {
    const playBtn = document.getElementById('playBtn');
    if (playBtn) playBtn.disabled = isPlaying;
  }

  function updateProgress() {
    const progressText = document.getElementById('progressText');
    const progressFill = document.getElementById('progressFill');
    const total = sentences.length;
    const current = Math.min(currentSentenceIndex + 1, total);
    if (progressText) progressText.textContent = total > 0 ? `${current}/${total}` : `0/0`;
    if (progressFill) progressFill.style.width = total > 0 ? `${(current / total) * 100}%` : '0%';
  }

  // 启动
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initReading);
  } else {
    initReading();
  }
})();