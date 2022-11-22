// JavaScript source code
document.getElementById('button').addEventListener('click', function () {
    document.querySelector('.backgroung-modal').style.display = 'flex';
});

document.querySelector('.close').addEventListener('click', function () {
    document.querySelector('.background-modal').style.display = 'none';
});