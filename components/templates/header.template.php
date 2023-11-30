<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900');
    
    header {
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        
        background-color: #303138;
        color: #EFEEEE;
        padding: 15px;
        text-align: center;
        height: 40px;
        width: 100%;
        
        font-family: 'Roboto', sans-serif;
        font-weight: normal;
        
        /*box-shadow: 0px 0px 10px 0px rgb(36, 37, 42, 0.2);
        */position: fixed;
    }
    
    header h1 {
        font-size: 1.5em;
        margin-left: 160px;
        margin-right: auto;
    }
    
    .header-right {
        position: relative;
        display: inline-block;
    }
    
    .my-acc-drop-btn{
        display: inline-block;
        margin-right: 160px;
        padding: 12px 18px;
        border-radius: 50px;
        background-color: #2A2B30;
        color: inherit;
        box-sizing: border-box;
        font-size: 1em;
        border: none;
        cursor: pointer;
        width: fit-content;
        max-width: 350px;
        height: fit-content;
        max-height: 50px;
        white-space: nowrap;
    }
    .drop_down-content{
        position: absolute;
        background-color: #2A2B30;
        width: fit-content;
        height: fit-content;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        z-index: 2;
        padding: 12px;
        right: 162px;
        top: 50px;
        border-radius: 10px;
        
        transform-origin: top center;
    }
    
    .drop_down-content.show{
        animation: acc-options-show 0.5s ease-in-out;
    }
    @keyframes acc-options-show{
        0%{
            transform: translateY(-10px) scale(1, 0);
        }
        50%{
            transform: translateY(0) scale(1, 1.2);
        }
        100%{
            transform: translateY(0) scale(1, 1);
        }
    }
    
    header .drop_down-content a{
        color: inherit;
        text-decoration: none;
        display: block;
        padding: 12px;
        font-size: 1em;
        margin: 2px 4px;
        min-width: 80px;
        border-radius: 10px;
    }
    
    header .drop_down-content a:hover{
        background-color: rgba(83, 83, 83, 0.44);
        border-radius: 8px;
    }
    
    header .drop_down-content a.action-danger{
        color: #FF0000;
    }
    header .drop_down-content a.action-danger:hover{
        background-color: rgba(255, 0, 0, 0.44);
    }
    
    header .hidden{
        display: none;
    }
    
</style>

<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<header>
    <h1>#TITLE#</h1>
    <div class="header-right">
        <button class="my-acc-drop-btn" onclick="accDropdownClick()">
            #DISPLAY_NAME#
            <i class="las la-angle-down"></i>
        </button>
        <div class="drop_down-content hidden">
            <a href="#" class="my-acc-action">Profile</a><hr>
            <a href="#" class="my-acc-action">Settings</a><hr>
            <a href="logout.php" class="my-acc-action action-danger">Logout</a>
        </div>
    </div>
</header>

<script type="application/javascript">

    function accDropdownClick(isFocusOut = false) {
        let dropdown = document.querySelector('header .drop_down-content');
        if(isFocusOut){
            dropdown.classList.add('hidden');
            dropdown.classList.remove('show');
        } else {
            dropdown.classList.toggle('show');
            dropdown.classList.toggle('hidden');
        }
        
        // Rotate the dropdown arrow icon
        let arrow = document.querySelector('header .my-acc-drop-btn i.las');
        if(dropdown.classList.contains('show')){
            arrow.classList.remove('la-angle-down');
            arrow.classList.add('la-angle-up');
        } else{
            arrow.classList.remove('la-angle-up');
            arrow.classList.add('la-angle-down');
        }
    }


</script>