import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
import {
    getFirestore,
    collection,
    setDoc,
    doc,
    where,
    query,
    Timestamp as Time,
    getDocs,
    orderBy,
    onSnapshot,
    updateDoc,
} from "https://www.gstatic.com/firebasejs/9.14.0/firebase-firestore.js";

export const Timestamp = Time;
// TODO: Replace the following with your app's Firebase project configuration
const firebaseConfig = {
    apiKey: "AIzaSyBRqLt_r4ig9kHgIQzfiHjDdn7Y3IpcZjc",
    authDomain: "tejarh-development.firebaseapp.com",
    projectId: "tejarh-development",
    storageBucket: "tejarh-development.appspot.com",
    messagingSenderId: "119887302986",
    appId: "1:119887302986:web:d605f0b16b0c695eb171b3",
    measurementId: "G-2NTNRLS4RB"
  };

const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

export async function CreateChat(buyer, seller, product) {
    try {
        const users = collection(db, `users`);
        const q = query(
            users,
            where("buyer_id", "==", parseInt(buyer?.id)),
            where("seller_id", "==", parseInt(seller?.id))
            
        );
        const queryResult = await getDocs(q);
        if (queryResult.empty) {
            return await setDoc(doc(users), {
                buyer,
                buyer_id: buyer?.id,
                seller_id: seller?.id,
                seller,
                // product,
                status: "",
                unread_messages_buyer: 0,
                unread_messages_seller: 0,
                last_message: "",
                last_message_time: "",
            });
        } else {
            return queryResult.docs[0].data();
        }
    } catch (error) {
        alert(error);
    }
}

export async function SendMessage(message, room) {
    try {
        const currentUser = localStorage.getItem("currentUser");
        const path = `chat_${room?.buyer_id}_${room?.seller_id}`;
        const chat = collection(db, path);
        const q = query(
            collection(db, `users`),
            where("buyer_id", "==", parseInt(room?.buyer_id)),
            where("seller_id", "==", parseInt(room?.seller_id))
        );
        const queryResult = await getDocs(q);
        if (!queryResult?.empty) {
            let prevData = queryResult?.docs[0].data();
            await setDoc(
                queryResult?.docs[0]?.ref,
                {
                    unread_messages_buyer:
                        currentUser == prevData.seller_id
                            ? prevData.unread_messages_buyer + 1
                            : prevData.unread_messages_buyer,
                    unread_messages_seller:
                        currentUser == prevData.buyer_id
                            ? prevData.unread_messages_seller + 1
                            : prevData.unread_messages_seller,
                    last_message: message?.text,
                    last_message_time: message?.time,
                },
                { merge: true }
            );
        }
        const chatRef = doc(chat);
        await setDoc(chatRef, message);

        return;
    } catch (error) {
        alert(error);
    }
}

function CreateMessage(type, data) {
    const currentUser = localStorage.getItem("currentUser");
    const isReceiver = `${data.senderId}` !== `${currentUser}`;
    switch (type) {
        case 0:
            return `
            <div class=${isReceiver ? "'s receive-chat'" : "'s send-chat'"}>
                <li class=${
                    isReceiver
                        ? "' chat-content receive-msg'"
                        : "' chat-content send-msg sender-msg'"
                }>
                ${data?.text}
                <span>${moment(data?.time?.toDate()).format("hh:mm")}</span>
                </li>
            </div>`;
        case 1:
            return `
            <div class=${isReceiver ? "'s receive-chat'" : "'s send-chat'"}>
                <li class=${
                    isReceiver
                        ? "' chat-content receive-msg'"
                        : "' chat-content send-msg sender-msg'"
                }>
                    <img 
                        style="height:200px;width:200px;object-fit:cover;"
                        src="${data?.imageUrl}"
                        alt="Image"
                    />
                    <span>${moment(data?.time?.toDate()).format("hh:mm")}</span>
                </li>
            </div>`;
    }
}

export async function BlockChat() {
    const room = JSON.parse(localStorage.getItem("chatRoom"));
    const path = `chat_${room?.buyer_id}_${room?.seller_id}`;

    try {
        // const room = JSON.parse(localStorage.getItem("chatRoom"));
        const pathParams = path.split("_");
        let buyer_id = pathParams[1];
        let seller_id = pathParams[2];
        if (room?.seller_id == seller_id) {
            const q = query(
                collection(db, `users`),
                where("buyer_id", "==", parseInt(buyer_id)),
                where("seller_id", "==", parseInt(seller_id))
            );
            const queryResult = await getDocs(q);
            if (!queryResult.empty) {
                let data = queryResult.docs[0].data();
                await setDoc(
                    queryResult.docs[0].ref,
                    {
                        status: "BLOCKED",
                    },
                    { merge: true }
                );
                const qs = query(
                    collection(db, `users`),
                    where("buyer_id", "==", parseInt(buyer_id)),
                    where("seller_id", "==", parseInt(seller_id))
                );
                const queryResults = await getDocs(qs);
                let datas = queryResults.docs[0].data();

                localStorage.setItem("chatRoom", JSON.stringify(datas));

                return datas;
            }
        } else {
            return room;
        }
    } catch (e) {
        alert(e);
        return null;
    }
}

export async function UnBlockChat() {
    const room = JSON.parse(localStorage.getItem("chatRoom"));
    const path = `chat_${room?.buyer_id}_${room?.seller_id}`;
    try {
        // const room = JSON.parse(localStorage.getItem("chatRoom"));
        const pathParams = path.split("_");
        let buyer_id = pathParams[1];
        let seller_id = pathParams[2];
        if (room?.seller_id == seller_id) {
            const q = query(
                collection(db, `users`),
                where("buyer_id", "==", parseInt(buyer_id)),
                where("seller_id", "==", parseInt(seller_id))
            );
            const queryResult = await getDocs(q);
            if (!queryResult.empty) {
                let data = queryResult.docs[0].data();
                await updateDoc(
                    queryResult.docs[0].ref,
                    {
                        status: 0,
                    },
                    { merge: true }
                );
                const qs = query(
                    collection(db, `users`),
                    where("buyer_id", "==", parseInt(buyer_id)),
                    where("seller_id", "==", parseInt(seller_id))
                );
                const queryResults = await getDocs(qs);
                let datas = queryResults.docs[0].data();

                localStorage.setItem("chatRoom", JSON.stringify(datas));
                return datas;
            }
        } else {
            return room;
        }
    } catch (e) {
        alert(e);
        return null;
    }
}
export async function ChangeRoom(path) {
    try {
        const room = JSON.parse(localStorage.getItem("chatRoom"));
        const currentUser = localStorage.getItem("currentUser");
        const pathParams = path.split("_");
        let buyer_id = pathParams[1];
        let seller_id = pathParams[2];
        if (room?.seller_id !== seller_id) {
            const q = query(
                collection(db, `users`),
                where("buyer_id", "==", parseInt(buyer_id)),
                where("seller_id", "==", parseInt(seller_id))
            );
            const queryResult = await getDocs(q);
            if (!queryResult.empty) {
                let data = queryResult.docs[0].data();
                await setDoc(
                    queryResult.docs[0].ref,
                    {
                        unread_messages_buyer:
                            currentUser == data.buyer_id
                                ? 0
                                : data.unread_messages_buyer,
                        unread_messages_seller:
                            currentUser == data.seller_id
                                ? 0
                                : data.unread_messages_seller,
                    },
                    { merge: true }
                );
                localStorage.setItem("chatRoom", JSON.stringify(data));
                return data;
            }
        } else {
            return room;
        }
    } catch (e) {
        alert(e);
        return null;
    }
}
export function ScrolltoBottom() {
    let items = document.querySelectorAll(".s");
    let last = items[items.length - 1];
    last.scrollIntoView({
        behavior: "smooth",
        block: "center",
        inline: "center",
    });
}
export async function GetMessages(path) {
    try {
        const tempBox = document.getElementById("box");
        tempBox.innerHTML = "";
        const chat = collection(db, path);
        const q = query(chat, orderBy("time", "asc"));
        const unsubscribe = onSnapshot(q, (querySnapshot) => {
            querySnapshot.docChanges().forEach((change, index) => {
                if (change.type === "added") {
                    const tempData = change.doc.data();

                    const messageBox = document.getElementById("box");
                    messageBox.innerHTML += CreateMessage(
                        tempData.type,
                        tempData
                    );
                    ScrolltoBottom();
                }
            });
        });
        return unsubscribe;
    } catch (error) {
        alert(error);
    }
}

export async function GetUsers(buyer_id) {
    const currentUser = localStorage.getItem("currentUser");
    const buyersRef = query(
        collection(db, "users"),
        where("buyer_id", "==", buyer_id)
    );
    const sellersRef = query(
        collection(db, "users"),
        where("seller_id", "==", buyer_id)
    );

    const q = query(collection(db, "users"));
    let unsubscribe = onSnapshot(
        q,
        { includeMetadataChanges: true },
        (querySnapshot) => {
            querySnapshot.docChanges().forEach((change, index) => {
                if (change.type === "modified") {
                    const docData = change.doc.data();
                    let path = `chat_${docData?.buyer_id}_${docData?.seller_id}`;
                    const countElement = document.getElementById(
                        `count_${path}`
                    );
                    const lastMessageElement = document.getElementById(path);
                    const lastMessageTimeElement = document.getElementById(
                        `time_${path}`
                    );
                    lastMessageElement.innerText = docData?.last_message;
                    lastMessageTimeElement.innerText = moment(
                        docData?.last_message_time?.toDate()
                    ).format("hh:mm");
                    countElement.innerText =
                        parseInt(docData.buyer_id) === parseInt(currentUser)
                            ? docData?.unread_messages_buyer
                            : docData?.unread_messages_seller;
                }
            });
        }
    );

    const buyersObj = await getDocs(buyersRef);
    const sellersObj = await getDocs(sellersRef);

    const buyers = [];
    const sellers = [];
    if (!buyersObj.empty) {
        buyersObj.forEach((doc) => {
            buyers.push(doc.data());
        });
    }
    if (!sellersObj.empty) {
        sellersObj.forEach((doc) => {
            sellers.push(doc.data());
        });
    }
    return { buyers, sellers };
}
