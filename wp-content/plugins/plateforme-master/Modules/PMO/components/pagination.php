<?php if (!defined('ABSPATH')) exit; ?>

<!-- Reusable Custom Pagination Component -->
<style>
    /* Custom Pagination Styles - Easy to customize */
    :root {
        --pagination-border-color: #b60303;
        --pagination-text-color: #b60303;
        --pagination-border-radius: 12px;
        --pagination-border-width: 2px;
        --pagination-button-size: 40px;
        --pagination-active-bg: #b60303;
        --pagination-active-text: #ffffff;
        --pagination-hover-bg: #f8f8f8;
        --pagination-spacing: 8px;
    }

    .custom-pagination {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: var(--pagination-spacing);
        margin: 20px 0;
        font-family: 'Inter', sans-serif;
    }

    .pagination-btn {
        width: var(--pagination-button-size);
        height: var(--pagination-button-size);
        border: var(--pagination-border-width) solid var(--pagination-border-color);
        background-color: white;
        color: var(--pagination-text-color);
        border-radius: var(--pagination-border-radius);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        user-select: none;
    }

    .pagination-btn:hover {
        background-color: var(--pagination-hover-bg);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(182, 3, 3, 0.2);
    }

    .pagination-btn:active {
        transform: translateY(0);
    }

    .pagination-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
        pointer-events: none;
    }

    .pagination-btn.active {
        background-color: var(--pagination-active-bg);
        color: var(--pagination-active-text);
        border-color: var(--pagination-active-bg);
    }

    .pagination-btn.active:hover {
        background-color: var(--pagination-active-bg);
        transform: none;
        box-shadow: none;
    }

    .pagination-page-number {
        font-size: 18px;
        font-weight: 600;
        color: #333;
        padding: 0 4px;
        min-width: 30px;
        text-align: center;
    }

    /* Hide default DataTables pagination */
    .dataTables_paginate {
        display: none !important;
    }

    .paginate_button {
        display: none !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        :root {
            --pagination-button-size: 35px;
            --pagination-spacing: 6px;
        }

        .pagination-btn {
            font-size: 14px;
        }

        .pagination-page-number {
            font-size: 16px;
        }
    }
</style>

<!-- Custom Pagination HTML -->
<div class="custom-pagination" id="customPagination">
    <button class="pagination-btn" id="firstPageBtn" title="Première page">
        <i class="fa fa-angle-double-left"></i>
    </button>
    <button class="pagination-btn" id="prevPageBtn" title="Page précédente">
        <i class="fa fa-angle-left"></i>
    </button>
    <span class="pagination-page-number" id="currentPageNumber">1</span>
    <button class="pagination-btn" id="nextPageBtn" title="Page suivante">
        <i class="fa fa-angle-right"></i>
    </button>
    <button class="pagination-btn" id="lastPageBtn" title="Dernière page">
        <i class="fa fa-angle-double-right"></i>
    </button>
</div>

<script>
    // Reusable Pagination Functions for PMO Components
    window.PMOPagination = {
        // Track multiple instances on a single page (for multiple tables/tabs)
        instances: [],

        // Initialize pagination for a DataTable
        // container can be a DOM element or a selector; if omitted, the first '.custom-pagination' will be used
        init: function(dataTable, container) {
            const containerEl = typeof container === 'string' ?
                document.querySelector(container) :
                (container || document.querySelector('.custom-pagination'));
            if (!dataTable || !containerEl) return;

            const instance = {
                dt: dataTable,
                container: containerEl
            };
            this.instances.push(instance);

            // Bind to DataTables draw event so our UI updates on any redraw (namespaced)
            if (typeof dataTable.on === 'function') {
                dataTable.off('draw.PMOPagination');
                dataTable.on('draw.PMOPagination', () => {
                    PMOPagination.update(instance);
                });
            }

            // Initialize event listeners for this container
            this.bindEvents(instance);

            // Initial sync
            this.update(instance);
        },

        // Bind pagination event listeners
        bindEvents: function(instance) {
            const {
                container,
                dt
            } = instance;
            const firstBtn = container.querySelector('#firstPageBtn');
            const prevBtn = container.querySelector('#prevPageBtn');
            const nextBtn = container.querySelector('#nextPageBtn');
            const lastBtn = container.querySelector('#lastPageBtn');

            // Remove existing listeners
            if (firstBtn) firstBtn.onclick = null;
            if (prevBtn) prevBtn.onclick = null;
            if (nextBtn) nextBtn.onclick = null;
            if (lastBtn) lastBtn.onclick = null;

            // First page
            if (firstBtn) {
                firstBtn.onclick = function(e) {
                    e.preventDefault();
                    if (dt && !firstBtn.disabled) {
                        dt.page('first').draw('page');
                    }
                };
            }

            // Previous page
            if (prevBtn) {
                prevBtn.onclick = function(e) {
                    e.preventDefault();
                    if (dt && !prevBtn.disabled) {
                        dt.page('previous').draw('page');
                    }
                };
            }

            // Next page
            if (nextBtn) {
                nextBtn.onclick = function(e) {
                    e.preventDefault();
                    if (dt && !nextBtn.disabled) {
                        dt.page('next').draw('page');
                    }
                };
            }

            // Last page
            if (lastBtn) {
                lastBtn.onclick = function(e) {
                    e.preventDefault();
                    if (dt && !lastBtn.disabled) {
                        dt.page('last').draw('page');
                    }
                };
            }
        },

        // Update pagination UI
        update: function(instance) {
            if (!instance || !instance.dt || !instance.container) return;

            try {
                const {
                    container,
                    dt
                } = instance;
                const info = dt.page.info();
                const firstBtn = container.querySelector('#firstPageBtn');
                const prevBtn = container.querySelector('#prevPageBtn');
                const nextBtn = container.querySelector('#nextPageBtn');
                const lastBtn = container.querySelector('#lastPageBtn');
                const currentPage = container.querySelector('#currentPageNumber');

                // Ensure elements exist
                if (!firstBtn || !prevBtn || !nextBtn || !lastBtn || !currentPage) {
                    console.warn('Pagination elements not found');
                    return;
                }

                // Update current page number
                currentPage.textContent = info.page + 1;

                // Update button states and styling
                const isFirstPage = info.page === 0;
                const isLastPage = info.page >= info.pages - 1;

                firstBtn.disabled = isFirstPage;
                prevBtn.disabled = isFirstPage;
                nextBtn.disabled = isLastPage;
                lastBtn.disabled = isLastPage;

                // Update button classes for styling
                firstBtn.classList.toggle('disabled', isFirstPage);
                prevBtn.classList.toggle('disabled', isFirstPage);
                nextBtn.classList.toggle('disabled', isLastPage);
                lastBtn.classList.toggle('disabled', isLastPage);

                // Always show custom pagination; buttons will be disabled when needed
                const paginationContainer = container;
                paginationContainer.style.display = 'flex';

                console.log('Pagination updated:', info.page + 1, 'of', info.pages);
            } catch (error) {
                console.error('Error updating pagination:', error);
            }
        },

        // Customize pagination appearance
        customize: function(options) {
            const root = document.documentElement;

            if (options.colors) {
                if (options.colors.border) root.style.setProperty('--pagination-border-color', options.colors
                    .border);
                if (options.colors.text) root.style.setProperty('--pagination-text-color', options.colors.text);
                if (options.colors.activeBg) root.style.setProperty('--pagination-active-bg', options.colors
                    .activeBg);
                if (options.colors.activeText) root.style.setProperty('--pagination-active-text', options.colors
                    .activeText);
                if (options.colors.hoverBg) root.style.setProperty('--pagination-hover-bg', options.colors.hoverBg);
            }

            if (options.sizes) {
                if (options.sizes.button) root.style.setProperty('--pagination-button-size', options.sizes.button +
                    'px');
                if (options.sizes.borderRadius) root.style.setProperty('--pagination-border-radius', options.sizes
                    .borderRadius + 'px');
                if (options.sizes.borderWidth) root.style.setProperty('--pagination-border-width', options.sizes
                    .borderWidth + 'px');
                if (options.sizes.spacing) root.style.setProperty('--pagination-spacing', options.sizes.spacing +
                    'px');
            }

            console.log('Pagination customized successfully!');
        }
    };
</script>