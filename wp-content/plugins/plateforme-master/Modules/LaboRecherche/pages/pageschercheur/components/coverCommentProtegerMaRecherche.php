<style>
/* * The main container. 
         * - 'position: relative' is crucial for positioning the text and icons on top.
         * - 'overflow: hidden' ensures that the child elements (like the image and overlay) respect the rounded corners.
        */
.cover-container {
    position: relative;
    max-width: 1040px;
    margin: 1.4rem auto;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

/* * The cover image itself.
         * - 'display: block' removes any extra space below the image.
         * - 'width: 100%' makes it responsive.
        */
.cover-container img {
    display: block;
    width: 100%;
    height: auto;
}


/* * Container for the text and icons.
         * - It's also positioned absolutely and uses flexbox to align its children.
        */
.cover-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 2;
    /* Sits on top of the overlay */
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 40px;
    box-sizing: border-box;
}

/* * The main text block on the left.
        */
.cover-text {
    color: #ffffff;
    font-size: 36px;
    font-weight: bold;
    line-height: 1.2;
}
</style>

<div class="cover-container">
    <img src="/wp-content/plugins/plateforme-master/images/newimages/Groupe de masques 433.png"
        alt="Person working on a laptop">

    <!-- The overlay content (text) -->
    <div class="cover-content">
        <div class="cover-text">
            COMMENT PROTÉGER<br>MA RECHERCHE?
        </div>

    </div>
</div>