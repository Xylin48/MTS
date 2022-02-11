function send(url, method, data, successFunc, errorFunc, timeout) {
  $.ajax({
    url: url,
    method: method,
    data: data,
    success: successFunc,
    error: errorFunc,
    cache: false,
    contentType: false,
    processData: false,
    timeout: timeout
  });
}

function upload(files) {
  const form = new FormData();
  form.append('0', files.item(0));
  $('.pfp').attr('src', 'https://cdn.danjaye.lol/media/1639106072000.gif');
  $.ajax({
    url: 'https://cdn.danjaye.lol',
    method: 'POST',
    data: form,
    success: function(data) {
      data = JSON.parse(data);
      $.ajax({
        url: '/api.php',
        method: 'POST',
        data: {
          action: {
            dest: 'account',
            type: 'modify',
            data: {
              pfp: data.files[0].path
            }
          }
        },
        success: function(data2) {
          $('.pfp').attr('src', data.files[0].path);
        },
        timeout: 10000
      });
    },
    cache: false,
    contentType: false,
    processData: false,
    timeout: 10000
  });
}

function save(dest, key, value, complete = function(){void(0);}) {
  let data = Object();
  data[key] = value;
  $.ajax({
    url: '/api.php',
    method: 'POST',
    data: {
      action: {
        dest: dest,
        type: 'modify',
        data: data
      }
    },
    complete: complete
  });
}

class Account {
  logOut() {
    $.ajax({

    })
  }
  modify(key, value) {
    save('account', key, value);
  }
}

/* 
  const account = new Account();
  account.logOut();
*/