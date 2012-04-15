using System;
using System.Collections;
using System.Configuration;
using System.Data;
using System.Linq;
using System.Web;
using System.Web.Security;
using System.Web.UI;
using System.Web.UI.HtmlControls;
using System.Web.UI.WebControls;
using System.Web.UI.WebControls.WebParts;
using System.Xml.Linq;

public partial class PayComplete : System.Web.UI.Page
{
    protected void Page_Load(object sender, EventArgs e)
    {
        string error_text = !string.IsNullOrEmpty(Request["error_text"]) ? Request["error_text"] : "";
        SohaPayment pay = new SohaPayment();
        bool check = pay.VerifyReturnUrl();

        string html = "";
        if (check && error_text == "")
            html += "<div align=\"center\">Thank you for payment complete</div>";
        else if (check)
            html += "Transaction have error";
        else
            html += "Secure secret is incorrect";
        Response.Write(html);

        
        string response_description = "";
        if (!string.IsNullOrEmpty(Request["payment_type"]))
        {
            if (Request["payment_type"] == "1") response_description = pay.GetResponseDescriptionInternational(Request["response_code"]);
            else if (Request["payment_type"] == "2") response_description = pay.GetResponseDescriptionDomestic(Request["response_code"]);
        }
        string respone_massage = "";
        if (!string.IsNullOrEmpty(Request["response_message"]))
        {
            respone_massage = Request["response_message"];
            Response.Write(respone_massage);
        }
    }
}
