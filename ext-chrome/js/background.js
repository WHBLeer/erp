// Copyright 2014 The Chromium Authors. All rights reserved.
// Use of this source code is governed by a BSD-style license that can be
// found in the LICENSE file.

localStorage['base_url'] = 'https://erp.whongbin.com/api/expand/';


function saveData(key,value){
	localStorage[key] = value;
}

function getData(key){
	return localStorage[key];
}
