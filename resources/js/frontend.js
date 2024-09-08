/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Todo 之後改 5
// require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
const csrf = {
  "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
};

toggleCommentEdit = () => {
  document.querySelector(".comment-body").classList.toggle("edit");
};

deleteComment = e => {
  const ok = confirm("Are you sure you want to delete this comment?");
  const actionUrl = e.target.dataset.action;
  const comment = e.target.closest(".media");
  if (!ok) return;
  fetch(actionUrl, {
    method: "DELETE",
    headers: csrf
  }).then(response => {
    if (response.status !== 200) {
      console.log("response.status", response.status);
    }
    comment.remove();
  }).catch(error => {
    console.error("Error:", error);
  });
};


document.querySelector(".comment-update")?.addEventListener("click", e => {
  e.preventDefault();
  // .comment-update 是表單中的按鈕，所以要用 closest 取得 form
  const actionUrl = e.target.closest('form').getAttribute('action');
  const comment = document.querySelector('input[name="comment"]').value;
  const post_id = document.querySelector('input[name="post_id"]').value;
  const name = document.querySelector('input[name="name"]').value;
  fetch(actionUrl, {
    method: "PUT",
    headers: {
      ...csrf,
      "Content-Type": "application/json"
    },
    body: JSON.stringify({ comment, post_id, name })
  }).then(response => {
    if (response.status !== 200) {
      console.log("response.status", response.status);
    }
    document.querySelector('.comment-content').innerHTML = comment;
    toggleCommentEdit();
  }).catch(error => {
    console.error("Error:", error);
  });
});