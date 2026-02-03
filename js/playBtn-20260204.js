  // ===== </body>前插入听读核心JS=====
  const speechSynthesis = window.speechSynthesis;
  let voices = [];
  let currentUtterance = null;
  let currentSentenceIndex = 0;
  let isPlaying = false;
  let sentences = [];
  const rate = 1;

  // ===== 判断是否为 PC 端（非移动设备）=====
  const isPC = !/Mobile|Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

  // 用户手势标记（仅用于移动端选读）
  let hasUserGesture = false;
  const recordGesture = () => { hasUserGesture = true; };
  if (!isPC) {
    document.body.addEventListener('click', recordGesture, { once: true });
    document.body.addEventListener('touchstart', recordGesture, { once: true });
  }

  // ✅【关键修复】安全包裹句子，保留 <a> 等所有 HTML 标签
  function createSentenceElements(element) {
    const walker = document.createTreeWalker(
      element,
      NodeFilter.SHOW_TEXT,
      null,
      false
    );

    const textNodes = [];
    let node;
    while (node = walker.nextNode()) {
      // 跳过已包裹的文本（避免重复处理）
      if (node.textContent.trim() && !node.parentElement.closest('.sentence')) {
        textNodes.push(node);
      }
    }

    // 从后往前处理，防止 DOM 变动影响遍历
    for (let i = textNodes.length - 1; i >= 0; i--) {
      const textNode = textNodes[i];
      const text = textNode.nodeValue;
      const parent = textNode.parentNode;

      // 按中文句号、问号、感叹号分割（保留标点）
      const parts = text.split(/(?<=[。！？!?])/g).filter(p => p.trim().length > 0);

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
    if (!printview) return;

    const textElements = printview.querySelectorAll('h1, p');
    textElements.forEach(el => createSentenceElements(el));
    sentences = Array.from(document.querySelectorAll('#printview .sentence'));

    waitForVoices().then(() => {
      setupEventListeners();
      bindSelectReadEvent();
      updateProgress();
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
    // 重新获取句子（因为 DOM 已更新）
    sentences = Array.from(document.querySelectorAll('#printview .sentence'));
    sentences.forEach((s, i) =>
      s.addEventListener('click', (e) => {
        // 阻止冒泡到链接等元素（但允许链接自身行为）
        if (!e.target.closest('a')) {
          handleClickSentence(i);
        }
      })
    );

    const playBtn = document.getElementById('playBtn');
    if (playBtn) {
      playBtn.addEventListener('click', () => handlePlayAction('play'));
    }
  }

  function bindSelectReadEvent() {
    const handler = () => {
      const selection = window.getSelection?.();
      if (!selection || selection.isCollapsed) return;

      const selectedText = selection.toString().trim();
      if (!selectedText) return;

      if (isPC) {
        readSelectedText(selectedText);
        // 清除选中（可选）
        selection.removeAllRanges();
      } else {
        if (hasUserGesture) {
          readSelectedText(selectedText);
          selection.removeAllRanges();
        } else {
          alert('请先点击页面任意位置，再使用选中朗读功能。');
        }
      }
    };

    const printview = document.getElementById('printview');
    if (printview) {
      printview.addEventListener('mouseup', handler);
      if (!isPC) {
        printview.addEventListener('touchend', handler);
      }
    }
    document.addEventListener('mouseup', handler);
    if (!isPC) {
      document.addEventListener('touchend', handler);
    }
  }

  function readSelectedText(text) {
    speechSynthesis.cancel();
    isPlaying = false;
    removeReadingStyles();
    updateButtonStates();
    updateProgress();

    const voiceSelect = document.getElementById('voiceSelect');
    const selectedVoiceIndex = voiceSelect ? parseInt(voiceSelect.value) : 0;

    const utterance = new SpeechSynthesisUtterance(text);
    utterance.lang = 'zh-CN';
    if (voices[selectedVoiceIndex]) utterance.voice = voices[selectedVoiceIndex];
    utterance.rate = rate;

    currentUtterance = utterance;
    speechSynthesis.speak(utterance);
  }

  function handlePlayAction(action) {
    if (action === 'play') {
      speechSynthesis.cancel();
      removeReadingStyles();
      currentSentenceIndex = 0;
      isPlaying = true;
      speakSentence(currentSentenceIndex);
    }
    updateButtonStates();
  }

  function handleClickSentence(index) {
    speechSynthesis.cancel();
    currentSentenceIndex = index;
    isPlaying = true;
    removeReadingStyles();
    speakSentence(currentSentenceIndex);
    updateButtonStates();
  }

  function speakSentence(index) {
    if (index >= sentences.length || index < 0) {
      isPlaying = false;
      removeReadingStyles();
      updateButtonStates();
      updateProgress();
      return;
    }

    speechSynthesis.cancel();
    currentSentenceIndex = index;
    updateHighlight(index);

    const voiceSelect = document.getElementById('voiceSelect');
    const selectedVoiceIndex = voiceSelect ? parseInt(voiceSelect.value) : 0;

    const utterance = new SpeechSynthesisUtterance(sentences[index].textContent);
    if (voices[selectedVoiceIndex]) utterance.voice = voices[selectedVoiceIndex];
    utterance.rate = rate;
    utterance.lang = 'zh-CN';

    utterance.onstart = function () {
      sentences[index].classList.add('current');
      updateButtonStates();
      updateProgress();
      sentences[index].scrollIntoView({ behavior: 'smooth', block: 'center' });
    };

    utterance.onend = function () {
      sentences[index].classList.remove('current');
      currentSentenceIndex++;
      speakSentence(currentSentenceIndex);
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
    if (playBtn) playBtn.disabled = isPlaying && speechSynthesis.speaking;
  }

  function updateProgress() {
    const progressText = document.getElementById('progressText');
    const progressFill = document.getElementById('progressFill');
    const total = sentences.length;
    const current = Math.min(currentSentenceIndex + 1, total);
    if (progressText) progressText.textContent = `${current}/${total}`;
    if (progressFill) progressFill.style.width = total > 0 ? `${(current / total) * 100}%` : '0%';
  }

  document.addEventListener('DOMContentLoaded', initReading);