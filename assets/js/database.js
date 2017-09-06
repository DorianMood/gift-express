
function initDB(itemName) { // Open (or create) the database
	// This works on all devices/browsers, and uses IndexedDBShim as a final fallback 
	var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;

	var open = indexedDB.open("WebDB", 1);

	// Create the schema
	open.onupgradeneeded = function() {
		var db = open.result;
		var store = db.createObjectStore("Storage", {keyPath: "id"});
		var index = store.createIndex("PicIndex", ["frame.x", "frame.y", "frame.height", "frame.width"]);
	};

	open.onsuccess = function() {
		// Start a new transaction
		var db = open.result;
		var tx = db.transaction("Storage", "readwrite");
		var store = tx.objectStore("Storage");
		var index = store.index("PicIndex");

		// Add some data
		store.put({id: 1, frame: {x: 1, y: 1, height: 1, width: 1}, pic: "111"});
		store.put({id: 1, frame: {x: 1, y: 1, height: 1, width: 1}, pic: "111"});
		store.put({id: 2, frame: {x: 2, y: 2, height: 2, width: 2}, pic: "222"});

		// Query the data
		var get1 = store.get(1);
		var get2 = index.get([2, 2, 2, 2]);

		get1.onsuccess = function() { console.log(get1.result.frame.x); };

		get2.onsuccess = function() { console.log(get2.result.frame.x); };

		// Close the db when the transaction is done
		tx.oncomplete = function() { db.close(); };
	}
}
function clearDB() {
	var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
	var open = indexedDB.open("WebDB", 1);

	open.onupgradeneeded = function() {
		var db = open.result;
		var store = db.createObjectStore("Picture", {keyPath: "id"});
		var index = store.createIndex("PicIndex", ["frme.x", "frame.y", "frame.height", "frame.width"]);
	}
	open.onsuccess = function() {
		var db = open.result;
		var tx = db.transaction("Picture", "readwrite");
		var store = tx.objectStore("Picture");
		var index = store.index("PicIndex");

		store.clear();

		return true;
	}
}
function saveDB(number, x, y, height, width) {
	var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
	var open = indexedDB.open("WebDB", 1);

	open.onupgradeneeded = function() {
		var db = open.result;
		var store = db.createObjectStore("Picture", {keyPath: "id"});
		var index = store.createIndex("PicIndex", ["frme.x", "frame.y", "frame.height", "frame.width"]);
		console.log('Creating object');
		return false;
	};
	open.onsuccess = function() {
		var db = open.result;
		var tx = db.transaction("Picture", "readwrite");
		var store = tx.objectStore("Picture");
		var index = store.index("PicIndex");

		store.put({id: number, frame: {x: x, y: y, height: height, width: width}});

		console.log('Added');

		return true;
	}
}

function extractDB(callback = null) {
	var indexedDB = window.indexedDB || window.mozIndexedDB || window.webkitIndexedDB || window.msIndexedDB || window.shimIndexedDB;
	var open = indexedDB.open("WebDB", 1);
	var items = [];
	open.onupgradeneeded = function() {
		var db = open.result;
		var store = db.createObjectStore("Picture", {keyPath: "id"});
		var index = store.createIndex("PicIndex", ["frme.x", "frame.y", "frame.height", "frame.width"]);
		console.log('Creating object');
		return null;
	};
	open.onsuccess = function() {
		var db = open.result;
		var tx = db.transaction("Picture", "readwrite");
		var store = tx.objectStore("Picture");
		var index = store.index("PicIndex");

		console.log('Extracting');
		var result = store.getAll();
		result.onsuccess = function() {
			items = result.result;
			callback(items);
		}
	}
	return items;
}
