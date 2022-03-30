const deleteForms = document.querySelectorAll('.delete-form');
deleteForms.forEach(form => {
    const title = form.getAttribute('data-name');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const accept = confirm(`Are you sure you want to delete ${title}?`);
        if (accept) e.target.submit();
    });
})