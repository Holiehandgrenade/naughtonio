function removeFromArray(arr, el) {
	for (var i = arr.length - 1; i >= 0; i--) {
		if (arr[i] == el) {
			arr.splice(i, 1);
		}
	}
}