@section('footer_script')
	<script>

document.getElementById("copyButton").addEventListener("click", function() {
    // document.getElementById("copyButton")[0].setAttribute("class", "clicked");
    copyToClipboard(document.getElementById("copyTarget"));
});

function copyToClipboard(elem) {
	// create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var target = document.getElementById(targetId);
    if (!target) {
        target = document.createElement("textarea");
        target.style.position = "absolute";
        target.style.left = "-9999px";
        target.style.top = "0";
        target.id = targetId;
        document.body.appendChild(target);
    }
    
    // get desired content
    if (elem.tagName === "INPUT" || elem.tagName === "TEXTAREA") {
        target.textContent = elem.value;
    } else {
        target.textContent = elem.textContent;
    }
    // select the content
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
    	  succeed = document.execCommand("copy");
          var copyBtn = $("#copyButton");
          copyBtn.addClass('clicked').html('copied');

    } catch(e) {
        succeed = false;
    }
    // clear content
    target.textContent = "";
    return succeed;
}


	</script>
@stop