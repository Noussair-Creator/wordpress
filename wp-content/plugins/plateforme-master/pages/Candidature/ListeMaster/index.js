function toggleAccordion(header) {
  const body = header.nextElementSibling;
  const isOpen = body.style.display === 'block';
  document.querySelectorAll('.accordion-body').forEach(b => b.style.display = 'none');
  body.style.display = isOpen ? 'none' : 'block';
}

