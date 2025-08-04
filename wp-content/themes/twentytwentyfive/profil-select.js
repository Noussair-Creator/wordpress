jQuery(document).ready(function($) {
    // Sélecteurs alternatifs pour user-edit.php ou user-new.php
    const roleSelect = $('#um-role').length ? $('#um-role') : $('#role');

    if (!roleSelect.length) return;

    const profilIdFromBackend = profil_ajax.profil_id || null;

    function injectProfilField() {
        $('#profil-selector-wrapper').remove(); // Supprime s’il existe déjà

        if (roleSelect.val() === 'um_chercheur') {
            $.post(profil_ajax.ajax_url, {
                action: 'get_profils_list',
                _ajax_nonce: profil_ajax.nonce
            }, function(response) {
                if (response.success && Array.isArray(response.data)) {
                    const profils = response.data;

                    const $row = $(`
                        <tr id="profil-selector-wrapper">
                            <th scope="row">
                                <label for="profil_id"><strong>Profil chercheur</strong></label>
                            </th>
                            <td>
                                <select name="profil_id" id="profil_id" class="regular-text" style="max-width: 320px;"></select>
                            </td>
                        </tr>
                    `);

                    profils.forEach(p => {
                        const safeNom = $('<div>').text(p.nom).html();
                        const selected = (p.id == profilIdFromBackend) ? 'selected' : '';
                        $row.find('select').append(`<option value="${p.id}" ${selected}>${safeNom}</option>`);
                    });

                    const $targetTable = roleSelect.closest('table');
                    $targetTable.append($row);
                }
            });
        }
    }

    // Chargement initial
    if (roleSelect.val() === 'um_chercheur') {
        injectProfilField();
    }

    // Sur changement de rôle
    roleSelect.on('change', function() {
        injectProfilField();
    });
});
