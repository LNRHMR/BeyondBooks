const dropzone = document.querySelector('.dropzone');
const fileInput = document.querySelector('#file');
const fileNameElement = document.getElementById('file-name');

dropzone.addEventListener('dragover', (e) => {
  e.preventDefault();
  dropzone.classList.add('dragover');
});

dropzone.addEventListener('dragleave', () => {
  dropzone.classList.remove('dragover');
});

dropzone.addEventListener('drop', (e) => {
  e.preventDefault();
  dropzone.classList.remove('dragover');
  fileInput.files = e.dataTransfer.files;
  const fileName = fileInput.files[0].name;
  fileNameElement.textContent = `File: ${fileName}`;
});

fileInput.addEventListener('change', () => {
  console.log(fileInput.files);
  const fileName = fileInput.files[0].name;
  fileNameElement.textContent = `File: ${fileName}`;
});