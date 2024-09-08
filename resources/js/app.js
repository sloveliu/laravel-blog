/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Todo 之後改 5
require('./bootstrap');

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

// const deletePost = id => {
// 改成全域宣告 = document.deletePost
deletePost = id => {
  const ok = confirm('Are you sure you want to delete this post?');
  if (!ok) return;
  const actionUrl = `/posts/${id}`;
  // 方法 1 透過 form 送出
  // const deleteForm = document.getElementById('deleteForm');
  // deleteForm.action = actionUrl;
  // deleteForm.submit();
  // 方法 2 透過 fetch 送出
  // 要先在 head 裡面加入 csrf 的 meta 標籤
  fetch(actionUrl, {
    method: "DELETE",
    headers: csrf
  }).then(response => {
      if (response.status !== 200) {
        console.log("response.status", response.status);
      }
      location.href = "/posts/admin";
  }).catch(error => {
      console.error("Error:", error);
    });
};

deleteCategory = id => {
  const ok = confirm('Are you sure you want to delete this category?');
  if (!ok) return;
  const actionUrl = `/categories/${id}`;
  fetch(actionUrl, {
    method: "DELETE",
    headers: csrf
  }).then(response => {
      if (response.status !== 200) {
        console.log("response.status", response.status);
      }
      location.href = "/categories";
  }).catch(error => {
      console.error("Error:", error);
    });
};

deleteTag = id => {
  const ok = confirm('Are you sure you want to delete this tag?');
  if (!ok) return;
  const actionUrl = `/tags/${id}`;
  fetch(actionUrl, {
    method: "DELETE",
    headers: csrf
  }).then(response => {
      if (response.status !== 200) {
        console.log("response.status", response.status);
      }
      location.href = "/tags";
  }).catch(error => {
      console.error("Error:", error);
    });
};