document.querySelector('a[href="produtos.html"]').addEventListener('click', function (event) {
    event.preventDefault();
    document.body.style.opacity = 0;
    setTimeout(() => {
      window.location.href = this.href;
    }, 500);
  });