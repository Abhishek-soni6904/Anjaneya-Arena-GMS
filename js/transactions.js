let table = $("#jquery-data-table").DataTable({
  responsive: {
    details: {
      type: "column",
      target: "tr",
    },
  },
  order: [[0, "desc"]],

  columnDefs: [
    { orderable: false, targets: -1 },
    { searchable: false, targets: -1 }, 
    { responsivePriority: 1, targets: [0, 1, 8, 6] },
  ],
  language: {
    search: "Search transactions:",
    lengthMenu: "Show _MENU_ entries",
    info: "Showing _START_ to _END_ of _TOTAL_ transactions",
    emptyTable: "No transactions found",
  },
});

function getdetail(data){
  if(data.action.includes('Extend')){
    return `<p><strong>New Expiration Date:</strong> ${data.new}</p>
    <p><strong>old Expiration Date:</strong> ${data.changedFrom}`
  }else{
    return ` <p><strong>Membership Type:</strong> ${data.new}</p>
            ${
              data.changedFrom
                ? `<p><strong>Changed From:</strong> ${data.changedFrom}</p>`
                : ""
            }`
  }
}
function printReceipt(data) {
  const receiptHTML = `
        <div class="receipt-header">
             <div class="logo">
                <img width="40px" src="assets/logo.png" alt="Anjaneya Arena Logo">
                <span>Anjaneya<br />Arena</span>
            </div>
            <p>Payment Receipt</p>
            <p>Receipt #${data.id}</p>
        </div>
        <div class="receipt-details">
            <p><strong>Member Name:</strong> ${data.memberName}</p>
            <p><strong>Date:</strong> ${new Date(
              data.payDate
            ).toLocaleDateString()}</p>
            <p><strong>Duration:</strong> ${data.duration} months</p>
            <p><strong>Payment Mode:</strong> ${data.payMode}</p>
            <p><strong>Action:</strong> ${data.action}</p>
            ${getdetail(data)}
        </div>
        <div class="receipt-total">
            <p style="margin: 0;">
                <span>Total Amount:</span>
                <span>₹${data.Total}</span>
            </p>
        </div>
        <div class="receipt-footer">
            <p>Thank you for choosing our gym!</p>
            <p style="font-size: 0.8rem; margin-top: 0.5rem;">This is a computer-generated receipt.</p>
        </div>
    `;

  document.getElementById("receiptContent").innerHTML = receiptHTML;
  document.getElementById("receiptModal").style.display = "block";

  // Print the receipt
  window.print();

  // Hide modal after printing
  setTimeout(() => {
    document.getElementById("receiptModal").style.display = "none";
  }, 500);
}
// Close modal when clicking outside
window.onclick = function (event) {
  const modal = document.getElementById("receiptModal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};
