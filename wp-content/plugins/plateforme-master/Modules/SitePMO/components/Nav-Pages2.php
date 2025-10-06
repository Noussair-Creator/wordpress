<style>
    /* Base styles from the memorized code */
    .nav-pages2 {
        background: #b60303;
        display: flex;
        align-items: center;
        justify-content: center;
        /* Aligned to the start */
        padding: 10px 20px 0;
        flex-wrap: nowrap;
        box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
    }

    .nav-scroll2 {
        display: flex;
        white-space: nowrap;
    }

    /* Adapted nav-link style to match the screenshot */
    .nav-link2 {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        padding: 15px 60px;
        font-size: 15px;
        display: inline-block;
        position: relative;
        line-height: 1.4;
        position: relative;
    }

    .nav-link2:not(:last-child)::after {
        content: '';
        position: absolute;
        /* top: 0px; */
        right: 0px;
        width: 2px;
        height: 23px;
        background-color: #FFFFFF4A;
    }

    a.nav-link2:hover {
        opacity: 0.9;
    }

    /* Style for the active link as shown in the screenshot */
    .nav-link2.active {
        font-weight: 700;
    }

    .nav-link2.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 25px;
        /* Aligns with padding */
        right: 25px;
        /* Aligns with padding */
        height: 3px;
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
        background-color: white;
    }
</style>


<div class="nav-pages2">
    <div class="nav-scroll2">
        <a href="#" class="nav-link2">UTM</a>
        <a href="/etablissements-utm" class="nav-link2">Etablissements</a>
        <a href="/structures-de-recherche-utm" class="nav-link2 active">Structures de recherche</a>
    </div>
</div>