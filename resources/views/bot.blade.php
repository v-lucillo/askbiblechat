@extends('layout.main')
@section('style')
    <style>
    .msger-inputarea {
        display: flex;
        /* padding: 10px; */
        /* border-top: var(--border); */
        /* background: #2b2c34; */
    }

    .msger-inputarea * {
        /* padding: 10px;
        border: none;
        border-radius: 3px;
        font-size: 1em; */
    }
    
    .msger-send-btn {
        border-color: rgb(25, 103, 210);
        color: rgb(25, 103, 210);
        background-color: rgb(255, 255, 255);
        outline: 0px;
        border-width: 0px 0px 0px;
    }

    .msger-input {
        margin-top: 10px;
        width: 100%;
        height: 50px;
        font-size: 25px;
        padding: 19px;
        margin: 15px 0px;
        outline: 0;
        border-width: 0px 0 1px;
    }
    

    :root {
    --body-bg: #202123;
    --msger-bg: #444654;
    /* --border: 2px solid #1e1e1e; */
    --left-msg-bg: #f0f0f0;
    --right-msg-bg: rgb(0, 132, 255);
    }


    .msger {
        display: flex;
        flex-flow: column wrap;
        justify-content: space-between;
        width: 100%;
        max-width: 867px;
        margin: 25px 10px;
        height: calc(100% - 50px);
        border: var(--border);
        border-radius: 5px;
        background: var(--msger-bg);
        box-shadow: 0 15px 15px -5px rgba(0, 0, 0, 0.2);
    }

    .msger-header {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border-bottom: var(--border);
        background: #2b2c34;
        color: #d9d9d9;
    }

    .msger-chat {
        flex: 1;
        overflow-y: auto;
        padding: 10px;
        font-size: 24px;
        height: 600px;
    }

    .msger-chat::-webkit-scrollbar {
        width: 6px;
    }

    .msger-chat::-webkit-scrollbar-track {
        background: #2b2c34;
    }

    .msger-chat::-webkit-scrollbar-thumb {
        background: #444654;
    }

    .msg {
        display: flex;
        align-items: flex-end;
        margin-bottom: 10px;
    }

    .msg:last-of-type {
        margin: 0;
    }

    .msg-img {
        width: 50px;
        height: 50px;
        margin-right: 10px;
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
        border-radius: 50%;
    }

    .msg-bubble {
        max-width: 800px;
        padding: 15px;
        border-radius: 10px;
        background: var(--left-msg-bg);
    }

    .msg-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .msg-info-name {
        margin-right: 10px;
        font-weight: bold;
    }

    .msg-info-time {
        font-size: 0.85em;
    }

    .left-msg .msg-bubble {
        border-bottom-left-radius: 0;
        
    }

    .right-msg {
        flex-direction: row-reverse;
    }

    .right-msg .msg-bubble {
        background: var(--right-msg-bg);
        color: #f6f9fa;
        border-bottom-right-radius: 0;
    }

    .right-msg .msg-img {
        margin: 0 0 0 10px;
    }

  

   
    .msger-send-btn:hover {
        background: #4c5563;
    }
    .sidebar {
        position: sticky;
        top: 0;
        height: 100%;
        width: 150px;
        background-color: #202123;
        padding-top: 20px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .tablink {
        display: block;
        color: #fff;
        text-align: left;
        padding: 8px 16px;
        text-decoration: none;
        font-size: 16px;
        border: none;
        background-color: #202123;
        width: 100%;
        cursor: pointer;
        transition: 0.3s;
    }

    .tablink.active {
    background-color: #444654;
        color: #fff;
    }


    /* Styles for the tab content */
    .tabcontent {
    display: none;
        padding: 20px;
        height: 100%;
    }

    /* Styles for the first tab */
    #tab1 {
        display: block;
    }

    .sidebar-header {
        font-weight: bold;
        text-align: center;
        margin-bottom: 26px;
        cursor: auto;
    }
    #delete-button {
        background: none!important;
        border: none;
        padding: 0!important;
        /*optional*/
        font-family: arial, sans-serif;
        /*input has OS specific font-family*/
        color: rgb(255, 255, 255);
        text-decoration: underline;
        cursor: pointer;
    }

    </style>
@endsection
@section('content')




<section>

</section>



<section class="bg-primary py-10">
    <div class="container px-5">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> Askbible.chat
                &nbsp; <input type="text" id="id" hidden> <span class="id_session" style = "display: none"></span>
            </div>
            <div class="msger-header-options">
                <button id="delete-button">Delete History</button>
            </div>
        </header>

        <main class="msger-chat">
        </main>

        <form class="msger-inputarea">
            <input class="msger-input" placeholder="Enter your message..." require>
            <button type="submit" class="msger-send-btn" ><img src="{{asset('askbible/img/send.png')}}" alt="" style = "width: 35px;"></button>
        </form>
    </div>
</section>




@endsection

@section('script')
<script src='https://use.fontawesome.com/releases/v5.0.13/js/all.js'></script>
<!-- <script src="./script.js"></script> -->

<script>
    if (getCookie("id") == "") {
        uuid = uuidv4()
        document.cookie = "id=" + uuid
        document.getElementById("id").value = uuid
    } else {
        document.getElementById("id").value = getCookie("id");
    }
    const idSession = get(".id_session");
    const USER_ID = document.getElementById("id").value;
    idSession.textContent = USER_ID
    getHistory()

    const msgerForm = get(".msger-inputarea");
    const msgerInput = get(".msger-input");
    const msgerChat = get(".msger-chat");
    const msgerSendBtn = get(".msger-send-btn");


    // Icons made by Freepik from www.flaticon.com
    const BOT_IMG = "{{asset('askbible/img/AskBibleIcon.png')}}";
    const PERSON_IMG = "https://api.dicebear.com/5.x/micah/svg?seed=" + document.getElementById("id").value
    const BOT_NAME = "ChatGPT";
    const PERSON_NAME = "You";

    // Function to delete chat history records for a user ID using the API
    function deleteChatHistory(userId) {
        if (!confirm("Are you sure? Your Session and History will delete for good.")) {
            return false
        }
        // '/api.php?user='
        fetch("{{route('c.deleteChatHistory')}}?_token={{ csrf_token() }}&user=" + USER_ID, {
            method: 'DELETE',
            headers: {'Content-Type': 'application/json'}
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error deleting chat history: ' + response.statusText);
                }
                deleteAllCookies()
                location.reload(); // Reload the page to update the chat history table
            })
            .catch(error => console.error(error));
    }

    // Event listener for the Delete button click
    const deleteButton = document.querySelector('#delete-button');
    deleteButton.addEventListener('click', event => {
        event.preventDefault();
        deleteChatHistory(USER_ID);
    });

    msgerForm.addEventListener("submit", event => {
        event.preventDefault();

        const msgText = msgerInput.value;
        if (!msgText) return;

        appendMessage(PERSON_NAME, PERSON_IMG, "right", msgText);
        msgerInput.value = "";

        sendMsg(msgText)
    });

    function getHistory() {
        var formData = new FormData();
        formData.append('user_id', USER_ID);
        formData.append('_token', "{{ csrf_token() }}");
        // '/api.php'
        fetch("{{route('c.get_history')}}", {method: 'POST', body: formData})
            .then(response => response.json())
            .then(chatHistory => {
                for (const row of chatHistory) {
                    appendMessage(PERSON_NAME, PERSON_IMG, "right", row.human);
                    appendMessage(BOT_NAME, BOT_IMG, "left", row.ai, "");
                }
            })
            .catch(error => console.error(error));
    }

    function appendMessage(name, img, side, text, id) {
        //   Simple solution for small apps
        const msgHTML = `
        <div class="msg ${side}-msg">
        <div class="msg-img" style="background-image: url(${img})"></div>
        <div class="msg-bubble">
            <div class="msg-info">
            <div class="msg-info-name">${name}</div>
            <div class="msg-info-time">${formatDate(new Date())}</div>
            </div>

            <div class="msg-text" id=${id}>${text}</div>
        </div>
        </div>
    `;

        msgerChat.insertAdjacentHTML("beforeend", msgHTML);
        msgerChat.scrollTop  = msgerChat.scrollHeight;

        // var elem = document.getElementById('data');
        // elem.scrollTop = elem.scrollHeight;
    }

    $('.msg-text').on('change', function(){
        console.log("Element is changing!");
    });

    function sendMsg(msg) {
        msgerSendBtn.disabled = true
        var formData = new FormData();
        formData.append('msg', msg);
        formData.append('user_id', USER_ID);
        formData.append('_token', "{{ csrf_token() }}");
        // '/send-message.php'
        fetch("{{route('c.send_message')}}", {method: 'POST', body: formData})
            .then(response => response.json())
            .then(data => {
                let uuid = uuidv4()
                // `/event-stream.php?chat_history_id=${data.id}&id=${encodeURIComponent(USER_ID)}`
                const eventSource = new EventSource("{{route('c.event_stream')}}?chat_history_id="+data.id+"&id="+encodeURIComponent(USER_ID));
                appendMessage(BOT_NAME, BOT_IMG, "left", "", uuid);
                const div = document.getElementById(uuid);

                eventSource.onmessage = function (e) {
                    if (e.data == "[DONE]") {
                        msgerSendBtn.disabled = false
                        eventSource.close();
                    } else {
                        let txt = JSON.parse(e.data).choices[0].delta.content;
                        msgerChat.scrollTop  = msgerChat.scrollHeight;
                        if (txt !== undefined) {
                            div.innerHTML += txt.replace(/(?:\r\n|\r|\n)/g, '<br>');
                        }
                    }
                };
                eventSource.onerror = function (e) {
                    msgerSendBtn.disabled = false
                    console.log(e);
                    eventSource.close();
                };
            })
            .catch(error => console.error(error));


    }

    // Utils
    function get(selector, root = document) {
        return root.querySelector(selector);
    }

    function formatDate(date) {
        const h = "0" + date.getHours();
        const m = "0" + date.getMinutes();

        return `${h.slice(-2)}:${m.slice(-2)}`;
    }

    function random(min, max) {
        return Math.floor(Math.random() * (max - min) + min);
    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }

    function uuidv4() {
        return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
            (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
        );
    }

    function deleteAllCookies() {
        const cookies = document.cookie.split(";");

        for (let i = 0; i < cookies.length; i++) {
            const cookie = cookies[i];
            const eqPos = cookie.indexOf("=");
            const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
            document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
        }
    }
</script>
@endsection