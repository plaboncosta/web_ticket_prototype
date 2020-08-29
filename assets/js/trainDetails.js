let first = document.getElementById('first');
let second = document.getElementById('second');
let third = document.getElementById('third');
let fourth = document.getElementById('fourth');

let route1 = document.getElementById('route1');
let route2 = document.getElementById('route2');
let route3 = document.getElementById('route3');
let route4 = document.getElementById('route4');

first.addEventListener('click', () => {
    route1.style.display = 'block';
    route2.style.display = 'none';
    route3.style.display = 'none';
    route4.style.display = 'none';
});

second.addEventListener('click', () => {
    route2.style.display = 'block';
    route1.style.display = 'none';
    route3.style.display = 'none';
    route4.style.display = 'none';
});

third.addEventListener('click', () => {
    route3.style.display = 'block';
    route2.style.display = 'none';
    route1.style.display = 'none';
    route4.style.display = 'none';
});

fourth.addEventListener('click', () => {
    route4.style.display = 'block';
    route2.style.display = 'none';
    route3.style.display = 'none';
    route1.style.display = 'none';
});
