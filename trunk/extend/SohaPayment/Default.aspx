<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Default.aspx.cs" Inherits="_Default" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title>SohaPay Demo</title>
    <style type="text/css">
        body
        {
        	font-family:Tahoma;
        	font-size:12px;
        }
        
        span
        {
        	display:block;
        }
        td
        {
        	vertical-align:top;
        }
    </style>
</head>
<body>
    <form id="form1" runat="server">
    <div>
        <table width="410px" align="center">
            <tr>
                <td align="center" colspan="2">
                    <h2>SohaPay Demo</h2>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Order Title
                </td>
                <td>
                    <asp:TextBox ID="txtTitle" runat="server" Width="321px"></asp:TextBox>
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator1" runat="server" 
                        ControlToValidate="txtTitle" ErrorMessage="Input order title"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Order Code
                </td>
                <td>
                    <asp:TextBox ID="txtCode" runat="server" Width="321px"></asp:TextBox>
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator2" runat="server" 
                        ControlToValidate="txtCode" ErrorMessage="Input order code"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Price
                </td>
                <td>
                    <asp:TextBox ID="txtPrice" runat="server" Width="321px"></asp:TextBox>
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator3" runat="server" 
                        ControlToValidate="txtPrice" ErrorMessage="Input order price"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Email
                </td>
                <td>
                    <asp:TextBox ID="txtEmail" runat="server" Width="321px"></asp:TextBox>
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator4" runat="server" 
                        ControlToValidate="txtEmail" ErrorMessage="Input order email"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Mobile
                </td>
                <td>
                    <asp:TextBox ID="txtMobile" runat="server" Width="321px"></asp:TextBox>
                    <asp:RequiredFieldValidator ID="RequiredFieldValidator5" runat="server" 
                        ControlToValidate="txtMobile" ErrorMessage="Input order mobile"></asp:RequiredFieldValidator>
                </td>
            </tr>
            <tr>
                <td align="right">
                    Detail
                </td>
                <td>
                    <asp:TextBox ID="txtDes" runat="server" TextMode="MultiLine" Width="321px">
                    </asp:TextBox>
                </td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <asp:Button ID="btnPay" Text="Payment" runat="server" onclick="btnPay_Click" />
                </td>
            </tr>
        </table>
    </div>
    </form>
</body>
</html>
