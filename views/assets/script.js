$(document).ready(function () {
  $(".RegisterLink").click(function () {
    window.location = "./register";
  });
  $(".LoginLink").click(function () {
    window.location = "./login";
  });

  $(".button-error").click(function () {
    window.location = ".";
  });

  $(".view-main").load("/controller/tasknotvalid.php");

  $(".button-reg").click(function () {
    let username = $("#sign-up input[name = 'username']").val();
    let mail = $("#sign-up input[name = 'mail']").val();
    let password = $("#sign-up input[name = 'password']").val();
    let day = $("#sign-up select[name = 'day']").val();
    let month = $("#sign-up select[name = 'month']").val();
    let year = $("#sign-up select[name = 'year']").val();
    let date = year + "-" + month + "-" + day;
    $.post(
      "./controller/register.php",
      {
        username: username,
        mail: mail,
        password: password,
        date: date,
      },

      function (data) {
        if (data != "") {
          $(".field-mail").empty();
          $(".field-username").empty();
          $(".field-password").empty();
          $(".field-born").empty();
          $(".field-username").removeClass("success");
          $(".field-username").removeClass("error");
          $(".field-mail").removeClass("success");
          $(".field-mail").removeClass("error");
          $(".field-password").removeClass("success");
          $(".field-password").removeClass("error");

          let datacut = data.split(",");

          if (datacut[0].includes("✅")) {
            $(".field").addClass("success");
            $(".field.success").append(datacut[0]);
            window.location = "./login";
          } else {
            if (datacut[1].includes("✅")) {
              $(".field-username").addClass("success");
              $(".field-username.success").append(datacut[1]);
            } else {
              $(".field-username").addClass("error");
              $(".field-username.error").append(datacut[1]);
            }
            if (datacut[2].includes("✅")) {
              $(".field-mail").addClass("success");
              $(".field-mail.success").append(datacut[2]);
            } else {
              $(".field-mail").addClass("error");
              $(".field-mail.error").append(datacut[2]);
            }
            if (datacut[3].includes("✅")) {
              $(".field-password").addClass("success");
              $(".field-password.success").append(datacut[3]);
            } else {
              $(".field-password").addClass("error");
              $(".field-password.error").append(datacut[3]);
            }
          }
        }
      }
    );
  });

  $(".button-log").click(function () {
    let mail = $("#sign-in input[name = 'mail']").val();
    let password = $("#sign-in input[name = 'password']").val();
    $.post(
      "./controller/connect.php",
      {
        mail: mail,
        password: password,
      },

      function (data) {
        if (data != "") {
          $(".field").empty();
          $(".field").removeClass("success");
          $(".field").removeClass("error");

          if (data.includes("✅")) {
            $(".field").addClass("success");
            window.location = "./todolist";
          } else {
            $(".field").addClass("error");
            $(".field.error").append(data);
          }
        }
      }
    );
  });

  $(".button-password").on("click", function () {
    let gettype = $(".password").attr("type");

    if (gettype == "password") {
      $(".path-pass").attr(
        "d",
        "M12 4c6.627 0 12 6.625 12 8s-5.373 8-12 8-12-6.625-12-8 5.373-8 12-8zm0 3a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"
      );
      $(".password").attr("type", "text");
    } else {
      $(".path-pass").attr(
        "d",
        "M1.393 4.222l1.415-1.414 18.384 18.384-1.414 1.415-3.496-3.497c-1.33.547-2.773.89-4.282.89-6.627 0-12-6.625-12-8 0-.752 1.607-3.074 4.147-5.024L1.393 4.222zM12 4c6.627 0 12 6.625 12 8 0 .752-1.607 3.074-4.147 5.024l-3.198-3.196a5 5 0 0 0-6.483-6.483L7.718 4.89C9.048 4.343 10.49 4 12 4zm-4.656 6.173a5 5 0 0 0 6.483 6.483l-1.661-1.66L12 15a3 3 0 0 1-3-3l.005-.166-1.66-1.66zM12 9a3 3 0 0 1 3 3l-.005.166-3.162-3.161L12 9z"
      );
      $(".password").attr("type", "password");
    }
  });

  $(".deco").click(function () {
    $.post(
      "./controller/deco.php",
      {},

      function () {
        window.location = "/";
      }
    );
  });

  $(".add-task-input").click(function () {
    let inputvalue = $(".input-add").val();

    $.post(
      "/controller/addtask.php",
      {
        inputvalue: inputvalue,
      },

      function () {
        $(".view-main").load("/controller/tasknotvalid.php");
      }
    );
  });

  $(".tasknotvalid").click(function () {
    $(".view-main").load("/controller/tasknotvalid.php");
  });

  $(".taskvalid").click(function () {
    $(".view-main").load("/controller/taskvalid.php");
  });

});
