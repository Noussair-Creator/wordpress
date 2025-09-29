jQuery(document).ready(function($) {
    $('#um-role').on('change', function () {
        const selected = $(this).val();
        $('#profil-selector-wrapper').remove();

        if (selected === 'um_chercheur') {
            $.post(profil_ajax.ajax_url, {
                action: 'get_profils_list',
                _ajax_nonce: profil_ajax.nonce
            }, function (response) {
                if (response.success) {
                    let html = '<div id="profil-selector-wrapper" style="margin-top:10px;">';
                    html += '<label for="profil_id"><strong>Profil chercheur :</strong></label>';
                    html += '<select name="profil_id" id="profil_id" class="regular-text">';
                    response.data.forEach(p => {
                        html += `<option value="${p.id}">${p.nom}</option>`;
                    });
                    html += '</select></div>';

                    $('#um-role').parent().append(html);
                }
            });
        }
    });
});
