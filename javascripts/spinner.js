const loaderContainer = document.querySelector('.loader-container');
window.addEventListener('load', () => {
  setInterval(function () {loaderContainer.style.display = 'none';}, 100);
});