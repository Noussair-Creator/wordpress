<style>
  /* Base styles from the memorized code */
  .nav-pages {
    background: var(--red);
    display: flex;
    align-items: center;
    justify-content: center;
    /* Aligned to the start */
    padding: 10px 20px 0;
    flex-wrap: nowrap;
    box-shadow: 0 7px 7px rgba(0, 0, 0, 0.1);
  }

  .nav-scroll {
    display: flex;
    white-space: nowrap;
  }

  /* Adapted nav-link style to match the screenshot */
  .nav-link {
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

  .nav-link:not(:first-child)::after {
    content: '';
    position: absolute;
    /* top: 0px; */
    left: 0px;
    width: 2px;
    height: 23px;
    background-color: #FFFFFF4A;
  }

  a.nav-link:hover {
    opacity: 0.9;
  }

  /* Style for the active link as shown in the screenshot */
  .nav-link.active {
    font-weight: 700;
  }

  .nav-link.active::after {
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


<div class="nav-pages">
  <div class="nav-scroll">
    <a href="#" class="nav-link active">UTM</a>
    <a href="#" class="nav-link">Liste etablissements</a>
  </div>
</div>