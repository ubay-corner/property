// MASUKKAN API KEY KAMU DISINI
Pi.init({
    version: "2.0",
    apiKey: "hokwpb4aevvfapb3ddy4nyxvoq5kumszrlizzcrmd7c7nbs6xfuqn6pbykz3qime"
});

// Fungsi log
function log(msg) {
    document.getElementById("log").textContent += "\n" + msg;
    console.log(msg);
}

// Callback Pi SDK
function onIncomplete(paymentId) {
    log("⚠ onIncomplete: " + paymentId);
}

function onCancel(paymentId) {
    log("❌ Dibatalkan: " + paymentId);
}

function onReadyForServerApproval(paymentId) {
    log("➡ SERVER: Approve pembayaran " + paymentId);
}

function onReadyForServerCompletion(paymentId) {
    log("➡ SERVER: Complete pembayaran " + paymentId);
}