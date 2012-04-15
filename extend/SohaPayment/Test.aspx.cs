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

using System.IO;
using System.Text;
using System.Security.Cryptography;
public partial class Test : System.Web.UI.Page
{
    public string ToHexa(byte[] data)
    {
        System.Text.StringBuilder sb = new StringBuilder();
        for (int i = 0; i < data.Length; i++)
            sb.AppendFormat("{0:X}", data[i]);
        return sb.ToString();
    }

    string pack(string data)
    {
        string key = "";
        key += Convert.ToString(Convert.ToInt32("e67d6d34", 16), 8);
        key += Convert.ToString(Convert.ToInt32("9fc23790", 16), 8);
        key += Convert.ToString(Convert.ToInt32("e33c", 16), 8);
        return key;

    }

    string CreateSHA256Signature(string key, string data)
    {
        byte[] convertedHash = new byte[key.Length / 2];
        for (int i = 0; i < key.Length / 2; i++)
        {
            convertedHash[i] = Convert.ToByte(int.Parse(key.Substring(i * 2, 2), System.Globalization.NumberStyles.HexNumber));
        }
        var hmacsha256 = new HMACSHA256(convertedHash);
        byte[] hashValue = hmacsha256.ComputeHash(Encoding.UTF8.GetBytes(data));
        string hexHash = "";
        foreach (byte test in hashValue)
        {
            hexHash += test.ToString("X2");
        }
        return hexHash;
    }

    protected void Page_Load(object sender, EventArgs e)
    {
        string ss = "e67d6d349fc23790e33c";
        string dd = "order_code=87351884&order_email=tung@likevn.com&order_mobile=0908512918&price=50000&return_url=http://test.apps.like.vn/sohapayment/paidcomplete&site_code=u189&transaction_info=thử hóa đơn đặt hàng&version=2";

        string data = CreateSHA256Signature(ss, dd);
        
        Response.Write(data);

        Response.End();
    }
}
