// import axios from './axios';
const axios = require('axios');


// const form = document.querySelector('form');
// const dialog = document.getElementById('dialog');
// const progressBar = document.getElementById('dialog');
// const progress = document.querySelector('progress');
// const progressText = document.getElementById('progress-text');
// const url = $('form').attr('action');

// form.addEventListener('submit', async (e) => {
//     e.preventDefault();

//     const formData = new FormData(form);

//     await axios.post(
//         url,
//         formData, {
//         headers: {
//             'Content-Type': 'multipart/form-data',
//         },
//         onUploadProgress: (progressEvent) => {
//             const percentCompleted = Math.round(
//                 (progressEvent.loaded * 100) / progressEvent.total
//             );
//             $('.dialog').css('display', 'block');
//             progress.value = percentCompleted;
//             progressText.innerText = `${percentCompleted}%`;
//         }
//     });
//     console.log('asdasdas');

//     // progressBar.style.display = 'none';
//     $('.dialog').css('display', 'none');

// });

// const form = document.querySelector('form');
// const dialog = document.getElementById('dialog');
// const progressBar = document.getElementById('dialog');
// const progress = document.querySelector('progress');
// const progressText = document.getElementById('progress-text');

// form.addEventListener('submit',
//     (progressEvent) => {
//         const percentCompleted = Math.round(
//             (progressEvent.loaded * 100) / progressEvent.total
//         );
//         $('.dialog').css('display', 'block');
//         progress.value = percentCompleted;
//         progressText.innerText = `${percentCompleted}%`;
//     });

// onUploadProgress: (progressEvent) => {
//     const percentCompleted = Math.round(
//         (progressEvent.loaded * 100) / progressEvent.total
//     );
//     $('.dialog').css('display', 'block');
//     progress.value = percentCompleted;
//     progressText.innerText = `${percentCompleted}%`;
// }
