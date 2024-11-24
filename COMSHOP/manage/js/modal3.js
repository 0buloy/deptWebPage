var imodal = document.getElementById('itemmodal');
var success = document.getElementById('successadded');
var emodal = document.getElementById('edititemmodal');
var dmodal = document.getElementById('delivermodal');
var ddmodal = document.getElementById('declinedelivermodal');

var acc = document.getElementById('accountm');

var deliveritemid = 0;
var rewards = 0;
var username = "";

function showDeliverModal(id)
{
	deliveritemid = id;
	dmodal.style.display = "block";
}

function updateDelivery()
{
	$.post('updatedelivery.php',{deliveritemid: deliveritemid, rewards: rewards, username: username},function(data)
			{
				
			}
		);
	
	deliveritemid = 0;
	
	location.reload();
}

function closeDeliverModal()
{
	dmodal.style.display = "none";
}

function showdDeliverModal(id)
{
	ddmodal.style.display = "block";
	deliveritemid = id;
}

function declineDelivery()
{
	var declineitemid = deliveritemid;
	
	var action = document.getElementById('declineaction').value;
	
	$.post('updatedelivery.php',{declineitemid: declineitemid, action: action},function(data)
			{
				
			}
		);
	
	declineitemid = 0;
	deliveritemid = 0;
	
	location.reload();
}

function closedDeliverModal()
{
	ddmodal.style.display = "none";
}


function showItemModal()
{
	imodal.style.display = "block";
}

function closeItemModal()
{
	imodal.style.display = "none";
}

function showAccModal()
{
	acc.style.display = "block";
}

function closeAccModal()
{
	acc.style.display = "none";
}

function showEditItemModal()
{
	emodal.style.display = "block";
}

function closeEditItemModal()
{
	emodal.style.display = "none";
	location="manage.php";
}

window.onclick = function(event)
{
	if (event.target == imodal)
	{
        imodal.style.display = "none";
    }
	if (event.target == emodal)
	{
        emodal.style.display = "none";
		location="manage.php";
    }
	if (event.target == success)
	{
        success.style.display = "none";
		location="manage.php";
    }
	if (event.target == acc)
	{
        acc.style.display = "none";
    }
	if (event.target == dmodal)
	{
        dmodal.style.display = "none";
    }
	if (event.target == ddmodal)
	{
        ddmodal.style.display = "none";
    }
}