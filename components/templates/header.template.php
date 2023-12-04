<style>
    @import url('https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900');
    
    header {
        box-sizing: border-box;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #303138;
        color: #EFEEEE;
        padding: 40px 5% 40px 5%;
        text-align: center;
        height: 40px;
        width: 100%;
        
        font-family: 'Roboto', sans-serif;
        font-weight: normal;
        
        /*box-shadow: 0px 0px 10px 0px rgb(36, 37, 42, 0.2);
        */position: fixed;
        max-width: 100vw;
    }
    
    header h1 {
        font-size: 1.5em;
        /*
        margin-left: 10%;
        */
    }
    
    .header-right {
        position: relative;
        display: inline-block;
    }
    
    .my-acc-drop-btn{
        display: inline-block;
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
    .drop-down-content{
        position: absolute;
        background-color: #2A2B30;
        width: fit-content;
        height: fit-content;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        z-index: 2;
        padding: 12px;
        right: 10px;
        top: 50px;
        border-radius: 10px;
        
        transform-origin: top center;
    }
    
    .drop-down-content.show{
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
    
    header .drop-down-content a{
        color: inherit;
        text-decoration: none;
        display: block;
        padding: 12px;
        font-size: 1em;
        margin: 2px 4px;
        min-width: 80px;
        border-radius: 10px;
    }
    
    header .drop-down-content a:hover{
        background-color: rgba(83, 83, 83, 0.44);
        border-radius: 8px;
    }
    
    header .drop-down-content a.action-danger{
        color: #FF0000;
    }
    header .drop-down-content a.action-danger:hover{
        background-color: rgba(255, 0, 0, 0.44);
    }
    
    header .hidden{
        display: none;
    }
    
    header hr{
        border: 1px solid #525252;
        margin: 4px 0;
    }
    
    header nav{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-left: 10%;
        margin-right: auto;
    }
    
    header .header-option{
        color: inherit;
        text-decoration: none;
        font-size: 1.2em;
        margin: 0 10px;
        padding: 10px 15px;
        border-radius: 10px;
        font-weight: 700;
    }
    
    header .header-option:hover{
        background-color: rgba(83, 83, 83, 0.44);
        border-radius: 8px;
    }
    
    header .header-option.selected{
        background-color: rgba(83, 83, 83, 0.44);
        border-radius: 8px;
    }
    
</style>

<link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
<header>
    <h1>#TITLE#</h1>
    <nav class="header-left">
        <a href="home.php?option=explore" class="header-option">Explore</a>
        <a href="home.php?option=saved" class="header-option">Saved</a>
        <a href="home.php?option=my-stuff" class="header-option">My Stuff</a>
    </nav>
    <div class="header-right">
        <button class="my-acc-drop-btn" onclick="accDropdownClick()">
            #DISPLAY_NAME#
            <i class="las la-angle-down"></i>
        </button>
        <div class="drop-down-content hidden">
            <div class="logged-in #LOGGED_IN_HIDDEN_CLASS#">
                <a href="#" class="my-acc-action">Profile</a><hr>
                <a href="#" class="my-acc-action">Settings</a><hr>
                <a href="logout.php" class="my-acc-action action-danger">Logout</a>
            </div>
            
            <div class="logged-out #LOGGED_OUT_HIDDEN_CLASS#">
                <a href="login.php" class="my-acc-action">Login</a>
            </div>
        </div>
    </div>
</header>

<script type="application/javascript">

    // Add event listener to document to close dropdown when clicked outside
    document.addEventListener('click', function(event) {
        let dropdown = document.querySelector('header .drop-down-content');
        let dropdownBtn = document.querySelector('header .my-acc-drop-btn');
        let dropdownArrow = document.querySelector('header .my-acc-drop-btn i.las');
        
        if(!dropdown.contains(event.target) && !dropdownBtn.contains(event.target)){
            dropdown.classList.remove('show');
            dropdown.classList.add('hidden');
            dropdownArrow.classList.remove('la-angle-up');
            dropdownArrow.classList.add('la-angle-down');
        }
    });
    
    function accDropdownClick() {
        let dropdown = document.querySelector('header .drop-down-content');
        dropdown.classList.toggle('show');
        dropdown.classList.toggle('hidden');
        
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