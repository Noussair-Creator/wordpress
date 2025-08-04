document.addEventListener('DOMContentLoaded', function() {
  // Initialize document data
  const documents = [
    { id: 1, date: '12/02/2023 - 11:27:08', title: 'Diplome', type: 'exchanged' },
    { id: 2, date: '12/02/2023 - 11:27:08', title: 'Diplome', type: 'pending' },
    { id: 3, date: '12/02/2023 - 11:27:08', title: 'Diplome', type: 'pending' }
  ];

  // Initialize action buttons
  const actionButtons = document.querySelectorAll('.action-btn');
  const statusCards = document.querySelectorAll('.status-card');
  let activeFilter = null;

  // Function to update table based on filter
  function updateTable(filterType) {
    const tbody = document.querySelector('.documents-table tbody');
    tbody.innerHTML = '';

    const filteredDocs = filterType ? 
      documents.filter(doc => doc.type === filterType) : 
      documents;

    filteredDocs.forEach(doc => {
      const row = document.createElement('tr');
      row.innerHTML = `
        <td>${doc.id}</td>
        <td>${doc.date}</td>
        <td>${doc.title}</td>
        <td><img src="../assets/pdf.png"
                                        style="width: 20px;height: 25px;    margin-left: 26px;"></i></td>
        <td><span class="status pending">En instance</span></td>
        <td>-</td>
        <td><button class="action-btn"><i class="fas fa-ellipsis-v"></i></button></td>
      `;
      tbody.appendChild(row);
    });

    // Reinitialize action buttons for new rows
    initializeActionButtons();
  }

  function initializeActionButtons() {
    document.querySelectorAll('.action-btn').forEach(button => {
      button.addEventListener('click', function(e) {
        e.preventDefault();
        const row = this.closest('tr');
        const number = row.cells[0].textContent;
        const date = row.cells[1].textContent;
        const title = row.cells[2].textContent;
        
        console.log('Document details:', { number, date, title });
      });
    });
  }

  // Add click handlers to status cards
  statusCards.forEach(card => {
    card.addEventListener('click', function() {
      // Remove active class from all cards
      statusCards.forEach(c => c.classList.remove('active'));
      
      let filterType = null;
      
      // If clicking the same card twice, remove filter
      if (activeFilter !== this.dataset.filter) {
        this.classList.add('active');
        filterType = this.dataset.filter;
        activeFilter = filterType;
      } else {
        activeFilter = null;
      }
      
      // Add visual feedback
      this.style.transform = 'scale(0.98)';
      setTimeout(() => {
        this.style.transform = '';
      }, 100);

      updateTable(filterType);
    });
  });

  // Add hover effect to table rows
  function initializeTableHover() {
    const tableRows = document.querySelectorAll('.documents-table tbody tr');
    
    tableRows.forEach(row => {
      row.addEventListener('mouseenter', function() {
        this.style.backgroundColor = '#f9fafb';
      });
      
      row.addEventListener('mouseleave', function() {
        this.style.backgroundColor = '';
      });
    });
  }

  // Initialize hover effects
  initializeTableHover();

  // Add transition effects
  document.querySelectorAll('.status-card, .action-btn').forEach(element => {
    element.style.transition = 'all 0.2s ease';
  });
});