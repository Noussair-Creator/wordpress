document.addEventListener('DOMContentLoaded', function() {
  // Add data labels for responsive view
  const tableRows = document.querySelectorAll('.applications-table tbody tr');
  
  tableRows.forEach(row => {
    const cells = row.querySelectorAll('td');
    cells[0].setAttribute('data-label', 'Master');
    cells[1].setAttribute('data-label', 'Etablissement');
    cells[2].setAttribute('data-label', 'Etat de candidature');
    cells[3].setAttribute('data-label', 'Actions');
  });

  // Handle view button clicks
  const viewButtons = document.querySelectorAll('.view-btn');
  viewButtons.forEach(button => {
    button.addEventListener('click', function() {
      // Get the row data
      const row = this.closest('tr');
      const master = row.cells[0].textContent;
      const establishment = row.cells[1].textContent;
      const status = row.cells[2].querySelector('.status').textContent;
      
      // Show application details (in a real application, this might open a modal or navigate to a details page)
    //   console.log('Viewing application details:', { master, establishment, status });
    //   alert(`Viewing application details for: ${master}`);
    });
  });

  // Handle pagination clicks
  const pageLinks = document.querySelectorAll('.page-link');
  pageLinks.forEach(link => {
    link.addEventListener('click', function(e) {
      e.preventDefault();
      
      // Remove active class from all links
      pageLinks.forEach(pl => pl.classList.remove('active'));
      
      // Add active class to clicked link
      this.classList.add('active');
      
      // In a real application, this would fetch and display the corresponding page of data
      console.log('Navigating to page:', this.textContent);
      
      // Simulate page change with a visual feedback
      const tbody = document.querySelector('.applications-table tbody');
      tbody.style.opacity = '0.5';
      setTimeout(() => {
        tbody.style.opacity = '1';
      }, 300);
    });
  });
});

const addBtn = document.getElementById('goto');

addBtn.addEventListener('click', () => {
    // window.location.href = "../gestion-relation-client/index.html";

});