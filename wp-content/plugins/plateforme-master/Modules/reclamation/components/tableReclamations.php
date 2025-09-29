<?php
// Préremplissage avec l'utilisateur connecté
$__u = wp_get_current_user();
$__full = trim($__u->display_name ?: trim(($__u->first_name ?? '') . ' ' . ($__u->last_name ?? '')));
$__email = $__u->user_email ?? '';
$__phone = get_user_meta($__u->ID ?? 0, 'phone', true);
if (!$__phone) {
  $__phone = get_user_meta($__u->ID ?? 0, 'billing_phone', true);
} // fallback éventuel
?>
<?php
if (!is_user_logged_in()) {
  return;
} // sécurité basique

$user = wp_get_current_user();
$full = trim(($user->first_name ?? '') . ' ' . ($user->last_name ?? ''));
$full = $full ?: $user->display_name;                // fallback
$email = $user->user_email;                           // e-mail WP
$phone = get_user_meta($user->ID, 'phone', true);     // si tu stockes un tel dans user_meta
$phone = $phone ?: get_user_meta($user->ID, 'mobile', true);
?>

<section id="reclamations-card">
    <style>
    /* === Scope strict au composant === */
    #reclamations-card {
        --ink: #2A2916;
        --edge: #ECEBE3;
        --line: #DBD9C3;
        --olive: #A6A485;
        --danger: #BF0404;
        display: block;
    }

    #reclamations-card,
    #reclamations-card * {
        box-sizing: border-box;
        font-family: "Segoe UI", Arial, sans-serif;
    }

    /* Carte globale */
    #reclamations-card .shell {
        width: auto;
        margin: 0 auto;
        background: #FFF;
        box-shadow: 0 3px 22px #0000000F;
        border-radius: 10px;
        padding: 18px 20px 0;
    }

    #reclamations-card .head {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 10px
    }

    #reclamations-card .head h2 {
        margin: 0;
        color: var(--ink);
        /* font:  ; */
        font-weight: 700;
        font-size: 20px/26px;
    }

    #reclamations-card .head .ico {
        width: 41px;
        height: 41px;
        object-fit: contain;
        display: block
    }

    #reclamations-card .sep {
        height: 1px;
        background: var(--edge);
        border: 0;
        margin: 6px 0 14px
    }

    /* Blocs internes */
    #reclamations-card .block {
        width: auto;
        margin: 0 auto 22px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 0 16px #0000001A;
        padding: 14px 16px;
    }

    #reclamations-card .block-title {
        color: var(--ink);
        font-weight: 700;
        font-size: 18px/24px;
        /* font: 700 18px/24px; */
        margin: 4px 0 10px
    }

    #reclamations-card .sub-sep {
        height: 1px;
        background: var(--edge);
        border: 0;
        margin: 6px 0 14px
    }

    /* Champs */
    #reclamations-card .row {
        display: grid;
        gap: 10px
    }

    #reclamations-card .row.two {
        grid-template-columns: 1fr 1fr
    }

    #reclamations-card .field {
        display: flex;
        align-items: center;
        height: 40px;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 5px;
        padding: 0 10px;
        color: var(--ink)
    }

    #reclamations-card input[type="text"],
    #reclamations-card input[type="email"],
    #reclamations-card textarea {
        width: 100%;
        height: 100%;
        border: 0;
        outline: 0;
        background: transparent;
        color: var(--ink);
        /* font: 500 14px/17px; */
        font-weight: 500;
        font-size: 14px/17px;
    }

    #reclamations-card textarea {
        min-height: 140px;
        padding: 10px 12px;
        resize: vertical
    }

    /* Téléphone : flag + chevron + input dans une seule zone */
    #reclamations-card .phone-field {
        display: flex;
        align-items: center;
        height: 40px;
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 5px;
        padding: 0 10px;
    }

    #reclamations-card .phone-left {
        display: flex;
        align-items: center;
        gap: 8px
    }

    #reclamations-card .phone-field .flag {
        width: 41px;
        height: 27px;
        border-radius: 3px;
        object-fit: cover;
        display: block;
    }

    #reclamations-card .phone-field .chev {
        width: 13px;
        height: 8px;
        display: inline-block;
        opacity: .9;
        background: url('/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-chevron-down.png') center/contain no-repeat;
    }

    #reclamations-card .phone-field .vbar2 {
        width: 1px;
        height: 60%;
        background: var(--line);
        margin: 0 10px;
    }

    #reclamations-card .phone-field input {
        flex: 1;
        height: 100%;
        border: 0;
        outline: 0;
        background: transparent;
        color: var(--ink);
        /* font: 600 14px/17px; */
        font-weight: 600;
        font-size: 14px/17px;
    }

    /* Fichier + Due */
    #reclamations-card .file-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        align-items: center;
        margin-top: 8px
    }

    #reclamations-card .file-left {
        display: grid;
        grid-template-columns: 1fr auto;
        border-radius: 5px;
        overflow: hidden
    }

    #reclamations-card .file-left input {
        padding: 0 10px;
        border: 1px solid var(--line);
        border-right: none;
        border-radius: 5px 0 0 5px
    }

    #reclamations-card .btn-import {
        display: flex;
        align-items: center;
        gap: 8px;
        background: var(--olive);
        color: #fff;
        border: none;
        padding: 0 14px;
        height: 40px;
        cursor: pointer;
        border-radius: 0 5px 5px 0;
        /* font: 500 15px/18px; */
        font-weight: 500;
        font-size: 15px/18px;
    }

    #reclamations-card .btn-import .up {
        width: 17px;
        height: 18px;
        transform: rotate(180deg)
    }

    #reclamations-card .date-wrap {
        position: relative;
        border: 1px solid var(--line);
        border-radius: 5px;
        height: 40px;
        display: flex;
        align-items: center;
        padding: 0 44px 0 10px
    }

    #reclamations-card .date-wrap input {
        height: 38px
    }

    #reclamations-card .date-wrap .vbar {
        position: absolute;
        right: 36px;
        top: 50%;
        transform: translateY(-50%);
        width: 1px;
        height: 17px;
        background: var(--line)
    }

    #reclamations-card .date-wrap .cal {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        border: none;
        background: #fff;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        cursor: pointer;
        display: grid;
        place-items: center
    }

    #reclamations-card .date-wrap .cal img {
        width: 18px;
        height: 18px
    }

    #reclamations-card .file-hint {
        margin: 6px 0 0 2px;
        /* font: 400 13px/16px; */
        font-weight: 400;
        font-size: 14px/17px;
        color: var(--ink)
    }

    /* Footer (dans la carte) */
    #reclamations-card .reclam-foot {
        width: 100%;
        background: #fff;
        border-top: 1px solid var(--edge);
        border-radius: 0 0 10px 10px;
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    #reclamations-card .agree {
        display: flex;
        align-items: center;
        gap: 12px
    }

    #reclamations-card .agree span {
        color: var(--ink);
        font-weight: 400;
        font-size: 14px/17px;
        /* font: 400 14px/17px; */
        text-transform: capitalize
    }

    #reclamations-card .chk {
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 2px;
        border: 1px solid var(--danger);
        background: #fff;
        cursor: pointer;
        position: relative
    }

    #reclamations-card .chk:checked {
        background: var(--danger);
        border-color: var(--danger)
    }

    #reclamations-card .chk:checked::after {
        content: "";
        position: absolute;
        left: 4px;
        top: 2px;
        width: 9px;
        height: 14px;
        border: solid #fff;
        border-width: 0 3px 3px 0;
        transform: rotate(45deg)
    }

    #reclamations-card .btn-send {
        width: 124px;
        height: 40px;
        background: var(--danger);
        color: #fff;
        border: none;
        border-radius: 5px;
        /* font: bold 15px/20px; */
        font-weight: bold;
        font-size: 15/20px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        cursor: pointer
    }

    #reclamations-card .btn-send img {
        width: 18px;
        height: 18px;
        filter: brightness(0) invert(1)
    }
    </style>

    <!-- Formulaire complet -->
    <form id="reclamForm" class="shell" enctype="multipart/form-data">
        <div class="head">
            <img class="ico" src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/11582800.png" alt="">
            <h2>Envoyer une réclamation</h2>
        </div>
        <hr class="sep">

        <!-- Bloc 1 -->
        <!-- Bloc 1 -->
        <div class="block">
            <div class="block-title">Informations Personnelles</div>
            <hr class="sub-sep">

            <div class="row two">
                <!-- Nom complet -->
                <div class="field">
                    <!-- visible désactivé -->
                    <input type="text" value="<?php echo esc_attr($full); ?>" placeholder="Ahlem Ben Amor" disabled>
                    <!-- valeur soumise -->
                    <input type="hidden" name="full_name" value="<?php echo esc_attr($full); ?>">
                </div>

                <!-- Email -->
                <div class="field">
                    <!-- visible désactivé -->
                    <input type="email" value="<?php echo esc_attr($email); ?>" placeholder="Ahlem@gmail.com" disabled>
                    <!-- valeur soumise -->
                    <input type="hidden" name="email" value="<?php echo esc_attr($email); ?>">
                </div>
            </div>

            <div class="row" style="margin-top:10px">
                <!-- Téléphone -->
                <label class="phone-field">
                    <span class="phone-left">
                        <img class="flag"
                            src="data:image/png;base64,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"
                            alt="TN">
                        <i class="chev" aria-hidden="true"></i>
                    </span>
                    <span class="vbar2" aria-hidden="true"></span>

                    <!-- visible désactivé -->
                    <input type="tel" value="<?php echo esc_attr($phone); ?>" placeholder="+21624156489" disabled>

                    <!-- valeur soumise -->
                    <input type="hidden" name="phone" value="<?php echo esc_attr($phone); ?>">
                </label>
            </div>
        </div>


        <!-- Bloc 2 -->
        <div class="block">
            <div class="block-title">Réclamation</div>
            <hr class="sub-sep">

            <div class="row">
                <div class="field"><input type="text" name="type" placeholder="Type"></div>
                <div class="field"><input type="text" name="subject" placeholder="Sujet"></div>
                <div class="field" style="height:auto"><textarea name="message" placeholder="Message"></textarea></div>

                <div class="file-grid">
                    <div class="file-left">
                        <input type="text" id="fileName" placeholder="Pièce jointe" readonly>
                        <button class="btn-import" type="button" id="btnImport">
                            <img class="up"
                                src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-upload.png"
                                alt="">
                            <span>Importer</span>
                        </button>
                        <input type="file" id="realFile" name="attachment" hidden>
                    </div>


                </div>

                <p class="file-hint">Taille maximale du fichier : 5000 Ko</p>
            </div>
        </div>

        <!-- Footer (dans la carte) -->
        <div class="reclam-foot">
            <label class="agree">
                <input type="checkbox" class="chk" id="anonymousBox">
                <span>Soumettre la réclamation de manière anonyme</span>
            </label>

            <button class="btn-send" type="submit" id="sendBtn">
                <img src="/wp-content/plugins/plateforme-master/images/icon%20etudiant/27)%20Icon-navigation-2.png"
                    alt="">
                Envoyer
            </button>
        </div>
    </form>

    <script>
    // ==== Config REST depuis PHP ====
    const RECLAM_API = "<?php echo esc_url(rest_url('plateforme/v1/reclamations')); ?>";
    const RECLAM_NONCE = "<?php echo esc_attr(wp_create_nonce('wp_rest')); ?>";

    (function() {
        // === Fichier : déclencheur + affichage nom de fichier
        const btn = document.getElementById('btnImport');
        const f = document.getElementById('realFile');
        const out = document.getElementById('fileName');
        if (btn && f) {
            btn.addEventListener('click', () => f.click());
            f.addEventListener('change', e => {
                const file = e.target.files && e.target.files[0];
                out.value = file ? file.name : '';
            });
        }


        // === Envoi REST
        const form = document.getElementById('reclamForm');
        const sendBtn = document.getElementById('sendBtn');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            const fd = new FormData(form);
            fd.append('anonymous', document.getElementById('anonymousBox').checked ? '1' : '0');

            const oldHTML = sendBtn.innerHTML;
            sendBtn.disabled = true;
            sendBtn.innerHTML = 'Envoi…';

            try {
                const res = await fetch(RECLAM_API, {
                    method: 'POST',
                    headers: {
                        'X-WP-Nonce': RECLAM_NONCE
                    },
                    body: fd,
                    credentials: 'same-origin'
                });
                const data = await res.json().catch(() => ({}));
                if (!res.ok) {
                    alert(data?.message || 'Échec de l’envoi.');
                } else {
                    
                    form.reset();
                    if (out) out.value = '';
                    window.location.href = "<?php echo esc_url(site_url('/suivi-reclamation')); ?>";
                }
            } catch (err) {
                alert('Erreur réseau : ' + err.message);
            } finally {
                sendBtn.disabled = false;
                sendBtn.innerHTML = oldHTML;
            }
        });
    })();
    </script>
</section>