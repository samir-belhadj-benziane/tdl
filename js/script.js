$(document).ready(function () {
  $("#sign-up").hide();
  $(".connect").click(function () {
    $(".field-username").removeClass("success");
    $(".field-username").removeClass("error");
    $(".field-username").empty();
    $(".username").css("border", "0.2px solid gray");

    $(".field-mail").removeClass("success");
    $(".field-mail").removeClass("error");
    $(".field-mail").empty();
    $(".mail").css("border", "0.2px solid gray");

    $(".field-password").removeClass("success");
    $(".field-password").removeClass("error");
    $(".field-password").empty();
    $(".password").css("border", "0.2px solid gray");

    $(".field").removeClass("success");
    $(".field").removeClass("error");
    $(".field").empty();

    $("#sign-up").hide();
    $("#sign-in").show();
  });

  $(".register").click(function () {
    $(".field-username").removeClass("success");
    $(".field-username").removeClass("error");
    $(".field-username").empty();
    $(".username").css("border", "0.2px solid gray");

    $(".field-mail").removeClass("success");
    $(".field-mail").removeClass("error");
    $(".field-mail").empty();
    $(".mail").css("border", "0.2px solid gray");

    $(".field-password").removeClass("success");
    $(".field-password").removeClass("error");
    $(".field-password").empty();
    $(".password").css("border", "0.2px solid gray");

    $(".field").removeClass("success");
    $(".field").removeClass("error");
    $(".field").empty();

    $("#sign-in").hide();
    $("#sign-up").show();
  });

  $("button[name = 'submit-sign-up']").click(function () {
    let username = $("#sign-up input[name = 'username']").val();
    let mail = $("#sign-up input[name = 'mail']").val();
    let password = $("#sign-up input[name = 'password']").val();
    $.post(
      "./include/register.php",
      {
        username: username,
        mail: mail,
        password: password,
      },

      function (data) {
        if (data != "") {
          $(".field-username").removeClass("success");
          $(".field-username").removeClass("error");
          $(".username").css("border", "0.2px solid gray");

          $(".field-mail").removeClass("success");
          $(".field-mail").removeClass("error");
          $(".mail").css("border", "0.2px solid gray");

          $(".field-password").removeClass("success");
          $(".field-password").removeClass("error");
          $(".password").css("border", "0.2px solid gray");

          let datafirstcut = data.split(",");

          let datafirstcutlength = datafirstcut[0].length;

          let datadatafirstcut0 = datafirstcut[0].split("/");
          let datadatafirstcut1 = datafirstcut[1].split("/");
          let datadatafirstcut2 = datafirstcut[2].split("/");
          let datadatafirstcut3 = datafirstcut[3].split("/");

          if (datafirstcutlength > 2) {
            $(".field").addClass("success");
            $(".field-username").empty();
            $(".field-mail").empty();
            $(".field-password").empty();
            $(".field.success").append(datadatafirstcut0[0]);
          } else {
            if (datadatafirstcut1[1] == 2) {
              $(".field-username").addClass("success");
              $(".username").css("border", "0.2px solid green");
              $(".field-username.success").empty();
              $(".field-username.success").append(datadatafirstcut1[0]);
            } else {
              $(".field-username").addClass("error");
              $(".username").css("border", "0.2px solid red");
              $(".field-username.error").empty();
              $(".field-username.error").append(datadatafirstcut1[0]);
            }

            if (datadatafirstcut2[1] == 2) {
              $(".field-mail").addClass("success");
              $(".mail").css("border", "0.2px solid green");
              $(".field-mail.success").empty();
              $(".field-mail.success").append(datadatafirstcut2[0]);
            } else {
              $(".field-mail").addClass("error");
              $(".mail").css("border", "0.2px solid red");
              $(".field-mail.error").empty();
              $(".field-mail.error").append(datadatafirstcut2[0]);
            }

            if (datadatafirstcut3[1] == 2) {
              $(".field-password").addClass("success");
              $(".password").css("border", "0.2px solid green");
              $(".field-password.success").empty();
              $(".field-password.success").append(datadatafirstcut3[0]);
            } else {
              $(".field-password").addClass("error");
              $(".password").css("border", "0.2px solid red");
              $(".field-password.error").empty();
              $(".field-password.error").append(datadatafirstcut3[0]);
            }
          }
        }
      }
    );
  });

  $("button[name = 'submit-sign-in']").click(function () {
    let mail = $("#sign-in input[name = 'mail']").val();
    let password = $("#sign-in input[name = 'password']").val();
    $.post(
      "./include/connect.php",
      {
        mail: mail,
        password: password,
      },

      function (data) {
        if (data != "") {
          $(".field").removeClass("success");
          $(".field").removeClass("error");

          let datacut = data.split("/");

          if (datacut[1] == 0) {
            $(".field").addClass("error");
            $(".field").empty();
            $(".field").append(datacut[0]);
          } else {
            if (datacut[1] == 2) {
              $(".field").addClass("success");
              $(".field.success").empty();
              $(".field.success").append(datacut[0]);
              window.location = "./todolist.php";
            } else {
              $(".field").addClass("error");
              $(".field.error").empty();
              $(".field.error").append(datacut[0]);
            }
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

  $(".disconnect").click(function () {
    $.post(
      "./include/disconnect.php",
      {},

      function () {
        window.location = ".";
      }
    );
  });

  $(".add-list").click(function () {
    let name = $(".namelist").val();
    $.post(
      "./include/addlist.php",
      {
        name: name,
      },

      function (data) {
        $(".add-list img").animate(
          { deg: 360 },
          {
            duration: 1200,
            step: function (now) {
              $(this).css({ transform: "rotate(" + now + "deg)" });
            },
          }
        );
        $(".container-multi-task").empty();
        $(".container-multi-task").append(data);
      }
    );
    document
      .getElementById("container-tasks-valid")
      .contentWindow.location.reload(true);
  });

  $(".valid-task").click(function () {
    var dataidvalid = $(this).attr("data-id");
    $.post(
      "./include/validlist.php",
      {
        idvalid: dataidvalid,
      },

      function (data) {
        $('[data-id="' + dataidvalid + '"] button').animate(
          { deg: 360 },
          {
            duration: 1200,
            step: function (now) {
              $(this).css({ transform: "rotate(" + now + "deg)" });
            },
          }
        );

        let datainfos = data.split("/");

        $('[data-id="' + dataidvalid + '"] button').empty();
        $('[data-id="' + dataidvalid + '"] button').append(datainfos[0]);

        $('[data-end="' + dataidvalid + '"] p').empty();
        $('[data-end="' + dataidvalid + '"] p').append(datainfos[1]);
      }
    );
  });

  $(".delete-task").click(function () {
    var dataiddelete = $(this).attr("data-iddelete");
    $.post(
      "./include/deletelist.php",
      {
        iddelete: dataiddelete,
      },

      function (data) {
        $('[data-iddelete="' + dataiddelete + '"] button').animate(
          { deg: 360 },
          {
            duration: 1200,
            step: function (now) {
              $(this).css({ transform: "rotate(" + now + "deg)" });
            },
          }
        );
        $('[data-glob="' + dataiddelete + '"]').remove();
        $(".container-multi-task").append(data);
      }
    );
  });
});
