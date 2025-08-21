<div class="comment-card">
    <h3>Commentaire interne</h3>
    <hr class="shadow">
    <div class="comment-body">
        <label for="commentaire">Commentaire</label>
        <span>
            <textarea id="commentaire" placeholder="Ajouter Un Commentaire ..."></textarea>
            <button class="btn-add-comment">Ajouter</button>
        </span>
        <div class="existing-comment">
            Tarek a bien avancé sur les aspects expérimentaux. Cependant, un retard est constaté sur la
            documentation formelle du dernier semestre. Prévoir une réunion fin juin pour relancer la rédaction.
        </div>
    </div>
</div>
<style>
.comment-body span {
    display: flex;
    justify-content: space-between;
    align-items: center;


}

/* Comment Card Styles */
.comment-card {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 4px rgba(0, 0, 0, 0.05);
    margin: 28px;
    padding: 24px;
}

.comment-card h3 {
    font-size: 21px;
    /* font-weight: bold; */
    /* border-bottom: 1px solid #eee; */
    padding: 20px 25px;
    margin: 0;
    color: #2A2916;
    border-radius: 8px 8px 0 0;
}

.comment-body {
    padding: 20px 25px;
}

.comment-body label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: #333;
}

.comment-body textarea {
    width: 85%;
    box-sizing: border-box;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    min-height: 80px;
    margin-bottom: 15px;
}

.comment-body .btn-add-comment {
    background: #FFFFFF;
    border: 1px solid #BF0404;
    color: #BF0404;
    border-radius: 5px;
    padding: 8px 25px;
    font-weight: 600;
    cursor: pointer;
    display: block;
    margin-left: auto;
}

.existing-comment {
    margin-top: 20px;
    padding: 15px;
    background-color: #f9f9f9;
    border: 1px solid #DBD9C3;
    border-radius: 5px;
    color: #000000ff;
    font-size: 14px;
    font-weight: 500;
}

.shadow {
    margin: 0px -24px;
    border: 1px solid;
}
</style>