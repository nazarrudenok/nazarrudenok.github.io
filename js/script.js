const changingTextContainer = document.getElementsByClassName('moments-cont')[0];
const changingText = document.getElementsByClassName('moments')[0];

const textArray = ["життя", "щастя", "дня", "секунд", "творчості", "радості"];

let currentIndex = 0;

function changeText() {
    const newText = textArray[currentIndex];
    changingText.textContent = newText;
    const textWidth = newText.length * 1;
    changingText.style.width = textWidth + 'ch';
    currentIndex = (currentIndex + 1) % textArray.length;
}

changingText.addEventListener('animationiteration', changeText);