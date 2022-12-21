const postsList = document.querySelector('.posts-list');

const sort = document.getElementById('sort-select');
const filter = document.getElementById('filter-select');

const modalEdit = document.querySelector('.modal-window__edit');
const closeEdit = document.querySelector('.close-btn-edit');

const detailsModal = document.querySelector('.details-modal');
const closeDetail = document.querySelector('.close-details');

const postsPages = document.querySelector('.posts-pages');

const title = document.querySelector("input[name='title']");
const content = document.querySelector("input[name='content']");
const st = document.querySelector("select[name='status']");

let stValue = st.value;

let sortValue = 5;
let filterValue = null;
let page = 1;

let totalPages = null;

closeEdit.addEventListener('click', function () {
  modalEdit.classList.remove('active');
});

sort.addEventListener(
  'change',
  async function (e) {
    page = 1;
    sortValue = e.target.value;
    await loadPosts();
  },
  false
);

st.addEventListener('change', function (e) {
  stValue = e.target.value;
});

filter.addEventListener('change', async function (e) {
  filterValue = e.target.value;
  await loadPosts();
});

async function loadPosts() {
  postsPages.innerHTML = '';
  postsList.innerHTML = '';
  const q = new URLSearchParams();
  q.append('sort', sortValue);
  q.append('filter', filterValue);
  q.append('page', page);
  const res = await fetch('http://localhost/utip-test/api/v1/posts?' + q);
  let data = await res.json();
  let posts = data[0];
  totalPages = data['page'];
  posts.forEach((post) => {
    postsList.innerHTML += `
    <div class="post-item">
    <div class="post-info">
      <div class="title">${post?.title}</div>
      <div class="body">${post?.content}</div>
    </div>
    <div class="post-btns">
      <button onclick="openDetail('${post?.id}')">View</button>
      <button onclick="selectPost('${post?.id}', '${post?.title}', '${post?.content}', '${post?.status}')">Edit</button>
      <button onclick="deletePost(${post?.id})">Delete</button>
    </div>
  </div>
`;
  });

  for (let i = 1; i <= totalPages; i++) {
    postsPages.innerHTML += `
    <span onclick="changePage('${i}')" class="page-item ${
      page == i ? 'active' : ''
    }">${i}</span>
  `;
  }
}

async function changePage(p) {
  page = p;
  await loadPosts();
}

let editId = null;

closeDetail.addEventListener('click', function () {
  detailsModal.classList.remove('active');
});

async function openDetail(id) {
  detailsModal.classList.add('active');

  const res = await fetch('http://localhost/utip-test/api/v1/posts/' + id);
  const data = await res.json();

  document.querySelector('.details-title').textContent = data.title;
  document.querySelector('.details-content__info').textContent = data.content;
}

function selectPost(id, title, content, status) {
  modalEdit.classList.add('active');
  editId = id;
  document.querySelector("select[name='status-edit']").value = Number(status);
  document.querySelector("input[name='title-edit']").value = title;
  document.querySelector("input[name='content-edit']").value = content;
}

async function createPost(id) {
  let formData = new FormData();
  formData.append('title', title.value);
  formData.append('content', content.value);
  formData.append('author_id', id);
  formData.append('status', stValue);

  const res = await fetch('http://localhost/utip-test/api/v1/posts', {
    method: 'POST',
    body: formData,
  });

  const data = await res.json();

  if (data.status) modal.classList.remove('active');
  await loadPosts();
}

async function deletePost(id) {
  const res = await fetch(`http://localhost/utip-test/api/v1/posts/${id}`, {
    method: 'DELETE',
  });

  if (res.status) await loadPosts();
}

async function updatePost() {
  const title = document.querySelector("input[name='title-edit']").value;
  const content = document.querySelector("input[name='content-edit']").value;
  const status = Number(
    document.querySelector("select[name='status-edit']").value
  );
  const id = editId;

  const data = {
    title,
    content,
    status,
  };

  const res = await fetch(`http://localhost/utip-test/api/v1/posts/${id}`, {
    method: 'PUT',
    body: JSON.stringify(data),
  });

  console.log(res);

  let resData = await res.json();
  if (resData.status) {
    await loadPosts();
    modalEdit.classList.remove('active');
  }
}

loadPosts();
