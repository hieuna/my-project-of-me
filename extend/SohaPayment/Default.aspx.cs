using System;
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

public partial class _Default : System.Web.UI.Page
{
    string return_url = "";

    public string RootUrl()
    {
        string url = "";
        if (HttpContext.Current.Request.ServerVariables["SERVER_PORT"] == "80")
            url = "http://" + HttpContext.Current.Request.ServerVariables["SERVER_NAME"];
        else
            url = "http://" + HttpContext.Current.Request.ServerVariables["SERVER_NAME"] + ":" + HttpContext.Current.Request.ServerVariables["SERVER_PORT"];
        if (Request.ApplicationPath != "/")
            url += Request.ApplicationPath;
        return url;
    }

    protected void Page_Load(object sender, EventArgs e)
    {
        if (!IsPostBack)
        {
            string[] pp = ("q,w,e,r,t,y,u,i,o,p,a,s,d,f,g,h,j,k,l,z,x,c,v,b,n,m,1,2,3,4,5,6,7,8,9").Split(',');
            string tmp = "";
            Random rd = new Random();
            for (int i = 1; i <= 15; i++)
            {
                tmp += pp[rd.Next(0, pp.Length-1)];
            }
            txtCode.Text = tmp.ToUpper();
        }
    }

    protected void btnPay_Click(object sender, EventArgs e)
    {
        string urlcheckout = "";
        SohaPayment pay = new SohaPayment();
        urlcheckout = pay.BuildCheckoutUrl(RootUrl() + "/PayComplete.aspx", txtTitle.Text, txtCode.Text, long.Parse(txtPrice.Text), txtEmail.Text, txtMobile.Text, txtDes.Text);

        //Response.Write(urlcheckout);

        Response.Redirect(urlcheckout);
    }
}
