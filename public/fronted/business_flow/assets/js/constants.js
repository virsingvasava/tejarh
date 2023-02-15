import {
    CreateChat,
    GetUsers,
    SendMessage,
    GetMessages,
    ChangeRoom,
    Timestamp,
    BlockChat,
    ScrolltoBottom,
    UnBlockChat,
} from "./firebaseConfig.js";
let Message = {
    text: "",
    time: Timestamp.now(),
    imageUrl: "",
    type: 0, // 0 = Text,1 = Image ,
    senderId: localStorage.getItem("currentUser") || "",
};
let unsubscribe;
let users;
// const BASE_URL = `http://localhost:8000/api`;
const BASE_URL = `http://67.205.148.222/tejarh-web/api`;
const imges_url = `http://67.205.148.222/tejarh-web/assets/users`;

async function GetImage(id){
    let formData = new FormData();
    formData.append("id", id);
    const result = await fetch(`${BASE_URL}/chat-user-images`, {
        method: "post",
        body: formData,
    }).then((res) => res.json());
    console.log(result)
    if(result?.data){
        return result?.data?.profile_picture
    }
}
function addUser(user, type) {
    var userList = document.getElementById("users");
    const path = `chat_${user?.buyer_id}_${user?.seller_id}`;
    if (user?.status === "BLOCKED") {
        type = "blocked";
    }

    userList.innerHTML += `
    <div class="post element-item ${type}" onclick="getMessages('${path}')"  data-cat='.${type}'>
        <div class="chat-box">
            <div class="chat-profile-pic">
                <img src="http://127.0.0.1:8000/assets/images/user.png">
            </div>
            <div class="chat-box-content">
                <h5 class="${type}-bg">
                    ${
                        type === "selling"
                            ? user?.buyer?.first_name
                            : user?.seller?.first_name
                    }
             <strong>${type}</strong>
                </h5>
                <p id='${path}'>${user.last_message}</p>
            </div>
            <div class="chat-msg">
                <h6 id='time_${path}'>
                    ${moment(
                        user?.last_message_time &&
                            user?.last_message_time?.toDate()
                    ).format("hh:mm")}
                </h6>
                <span id='count_${path}' class="chat-msg-count">
                    ${
                        type == "buying"
                            ? user?.unread_messages_buyer
                            : user?.unread_messages_buyer
                    }
                </span>
            </div>
        </div>
    </div>
    `;
}

window.filterList = async function filterList(tag) {
    var userList = document.getElementById("users");
    userList.innerHTML = "";
    if (tag === "all") {
        users?.buyers?.map((buyer) => {
            addUser(buyer, "buying");
        });
        users?.sellers?.map((seller) => {
            addUser(seller, "selling");
        });
    } else if (tag === "buying") {
        users?.buyers?.map((buyer) => {
            addUser(buyer, "buying");
        });
    } else if (tag === "selling") {
        users?.sellers?.map((seller) => {
            addUser(seller, "selling");
        });
    } else if (tag === "blocked") {
        users?.sellers?.map((seller) => {
            addUser(seller, "blocked");
        });
    }
};
window.initialLoad = async function initialLoad(buyer_id, seller_id) {
    users = await GetUsers(buyer_id);
    const chatWrapper = document.querySelector(".right-chat-box-wrapper");
    // chatWrapper.dis
    localStorage.setItem("currentUser", buyer_id);
    filterList("all");
};

window.closePreview = function closePreview() {
    const chatWrapper = document.getElementById("preview-wrapper");
    chatWrapper.hidden = true;
    const chatBox = document.getElementById("box");
    chatBox.hidden = false;
    Message.type = 0;
};
window.createPreview = function createPreview(file) {
    try {
        if (file) {
            const chatBox = document.getElementById("box");
            chatBox.hidden = true;
            const imagePreview = document.getElementById("preview-image");
            imagePreview.setAttribute("src", URL.createObjectURL(file));
            const chatWrapper = document.getElementById("preview-wrapper");
            chatWrapper.hidden = false;
            Message.imageUrl = file;
            Message.type = 1;
        }
    } catch (error) {
        alert(error);
    }
};

window.blockCurrentUser = async function blockCurrentUser() {
    try {
        await BlockChat();
        unsubscribe && unsubscribe();
        window.location.reload();
        //await ChangeRoom(path);
    } catch (error) {}
};
window.unBlockCurrentUser = async function unBlockCurrentUser() {
    try {
        await UnBlockChat();
        unsubscribe && unsubscribe();
        window.location.reload();
    } catch (error) {}
};

window.getMessages = async function getMessages(path) {
    const room = await ChangeRoom(path);
    const currentUser = localStorage.getItem("currentUser");
    if (room) {
        const title = document.getElementById("title");
        const location = document.getElementById("location");
        title.innerText =
            currentUser == room?.buyer_id
                ? room?.seller?.first_name
                : room?.buyer?.first_name;
        location.innerText =
            currentUser == room?.buyer_id
                ? room?.seller?.address
                : room?.buyer?.address;
        unsubscribe && unsubscribe();
        unsubscribe = await GetMessages(path);
    }
};

window.createMediaMessage = async function createMediaMessage(room) {
    try {
        var file = Message.imageUrl;
        console.log(file);
        let formData = new FormData();
        formData.append("image", file);
        const imageUrl = await fetch(`${BASE_URL}/chat/upload/document`, {
            method: "post",
            body: formData,
        }).then((res) => res.text());

        Message.text = "Image";
        Message.imageUrl = imageUrl;
        Message.type = 1;
        Message.time = Timestamp.now();
        await SendMessage(Message, room);
        closePreview();
    } catch (error) {
        alert(error);
    }
};

window.createTextMessage = async function createTextMessage(room) {
    try {
        var x = document.getElementById("chat_message_text").value;
        Message.text = x;
        Message.time = Timestamp.now();
        await SendMessage(Message, room);
    } catch (error) {
        alert(error);
    }
};
window.createChat = function createChat(buyer, seller, product) {
    CreateChat(buyer, seller, product).then((res) => {
        window.location.href = window.location.pathname.replace(
            window.location.pathname,
            `http://67.205.148.222/tejarh-web/business/chat`
        );
    });
};
window.sendMessage = async function sendMessage() {
    const room = JSON.parse(localStorage.getItem("chatRoom"));

    if (Message.type) {
        await createMediaMessage(room);
    } else {
        await createTextMessage(room);
    }
    document.getElementById("chat_message_text").value = "";
    document.getElementById("chat_message_media").value = "";
    Message.text = "";
    Message.imageUrl = "";
    Message.type = 0;
    ScrolltoBottom();
};
