<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Help - Email Verification</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<style>
  ul.navega li {
    display: inline;
    padding-right: 0.5em;
  }

  .rosado {
    letter-spacing: 6px;
    color: #ebaaff;
  }
</style>

<body style="margin: 0; padding: 0; box-sizing: border-box;">
  <table align="center" cellpadding="0" cellspacing="0" width="95%">
    <tr>
      <td align="center">
        <table align="center" cellpadding="0" cellspacing="0" width="600" style="border-spacing: 2px 5px;">
          <tr bgcolor="#000">
            <td align="center" style="padding: 30px 5px 30px 5px;">

              <img src="{{asset('Dashboard/EXCELSIOR.png')}}" alt="">
            </td>
          </tr>
          <tr>
            <td bgcolor="#fff">
              <table cellpadding="0" cellspacing="0" width="100%">
                <tr>
                  <td style="padding: 10px 20px 10px 20px; font-family: Nunito, sans-serif; font-size: 20px; font-weight:500;margin-left:25px;color:#000;">
                  Correo: Solicitud de retiro
                  </td>
                </tr>
                <tr>
                  <td style="padding: 20px 20px 10px 20px; font-family: Nunito, sans-serif; font-size: 16px;color:#676D7D;">
                  Usuario: {{$user}}
                  </td>
                </tr>
                <tr>
                  <td style="padding: 20px 20px 10px 20px; font-family: Nunito, sans-serif; font-size: 16px;color:#676D7D;">
                  Total a Recibir: <b>{{$total}}$
                  </td>
                </tr>
                <tr>
                  <td style="padding: 20px 20px 10px 20px; font-family: Nunito, sans-serif; font-size: 16px;color:#676D7D;">
                  Este es su codigo de retiro pendiente, vigente por solo 30 minutos
                  </td>
                </tr>

                <tr>
                <td style="padding: 20px 20px 10px 20px; font-family: Nunito, sans-serif; font-size: 16px;color:#676D7D;">
                    Codigo: <span style="font-weight: 800;color:#000;">{{$code}}</span>
                  </td>
                </tr>
                <tr bgcolor="#000">
                  <td style="padding: 25px 0; font-family: Nunito, sans-serif; font-size: 16px;">
                    <ul class="navega">
                      <li>
                      <img  width="50%" height="10" src="{{asset('Dashboard/SLOGAN-07.png')}}" alt="">
                      </li>
                      <li>
                        <img width="50" height="50" src="{{asset('Dashboard/IMAGOEXCELESIOR-19/IMAGOEXCELESIOR-19.png')}}" alt="" style="float: right;margin-right:20px;">
                      </li>
                    </ul>

                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>