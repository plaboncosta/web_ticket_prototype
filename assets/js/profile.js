let profile = document.getElementById('profile');
let trip = document.getElementById('trip');
let meals = document.getElementById('meals');
let sub = document.getElementById('sub');
let complaint = document.getElementById('complaint');

let pro1 = document.getElementById('pro1');
let pro2 = document.getElementById('pro2');
let pro3 = document.getElementById('pro3');
let pro4 = document.getElementById('pro4');
let pro5 = document.getElementById('pro5');

profile.addEventListener('click', () => {
    profile.style.background = '#90c7b4';
    trip.style.background = 'transparent';
    meals.style.background = 'transparent';
    sub.style.background = 'transparent';
    complaint.style.background = 'transparent';
    pro1.style.display = 'block';
    pro2.style.display = 'none';
    pro3.style.display = 'none';
    pro4.style.display = 'none';
    pro5.style.display = 'none';
});

trip.addEventListener('click', () => {
    trip.style.background = '#90c7b4';
    profile.style.background = 'transparent';
    meals.style.background = 'transparent';
    sub.style.background = 'transparent';
    complaint.style.background = 'transparent';
    pro2.style.display = 'block';
    pro1.style.display = 'none';
    pro3.style.display = 'none';
    pro4.style.display = 'none';
    pro5.style.display = 'none';
});

meals.addEventListener('click', () => {
    meals.style.background = '#90c7b4';
    trip.style.background = 'transparent';
    profile.style.background = 'transparent';
    sub.style.background = 'transparent';
    complaint.style.background = 'transparent';
    pro3.style.display = 'block';
    pro2.style.display = 'none';
    pro1.style.display = 'none';
    pro4.style.display = 'none';
    pro5.style.display = 'none';
});

sub.addEventListener('click', () => {
    sub.style.background = '#90c7b4';
    trip.style.background = 'transparent';
    meals.style.background = 'transparent';
    profile.style.background = 'transparent';
    complaint.style.background = 'transparent';
    pro4.style.display = 'block';
    pro2.style.display = 'none';
    pro3.style.display = 'none';
    pro1.style.display = 'none';
    pro5.style.display = 'none';
});

complaint.addEventListener('click', () => {
    complaint.style.background = '#90c7b4';
    trip.style.background = 'transparent';
    meals.style.background = 'transparent';
    sub.style.background = 'transparent';
    profile.style.background = 'transparent';
    pro5.style.display = 'block';
    pro2.style.display = 'none';
    pro3.style.display = 'none';
    pro4.style.display = 'none';
    pro1.style.display = 'none';
});
