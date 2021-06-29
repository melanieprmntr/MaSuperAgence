/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
let $ = require('jquery')
import './styles/app.css';
require(`select2`);

// loads the jquery package from node_modules
// import jquery from 'jquery';


$('select').select2()

$('#contactButton').click(e => {
    console.log('hello');
    e.preventDefault();
    $('#contactForm').slideDown();
    $('#contactButton').slideUp();
})

//Suppression des éléments

document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault()
        fetch(a.getAttribute('href'), {
            method: 'DELETE',
            headers: {
                'X-Requested-With': ' XMLHttpRequest',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ '_token': a.dataset.token })
        }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode)
                } else {
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
})


// import the function from greet.js (the .js extension is optional)
// ./ (or ../) means to look for a local file
// import greet from './greet';

// $(document).ready(function() {
//      $('body').prepend('<h1>'+greet('jill')+'</h1>');
// });


// start the Stimulus application
import './bootstrap';
import { data } from 'jquery';


