using System;
using System.Data;
using System.Configuration;
using System.Linq;
using System.Xml.Linq;
using System.Collections;
using System.Collections.Generic;
using System.Web;
using System.Security.Cryptography;
using System.Text;

/// <summary>
/// Summary description for SohaPayment
/// </summary>

public class SohaPayment
{
    // URL for publish website
    // public const string PG_ROOT_URL = "https://sohapay.com/";
    // URL for developer testing
    public const string PG_ROOT_URL = "http://paydev.todo.vn/";

    /// <summary>
    /// URL Checkout payment
    /// </summary>
    string PG_url = "payment.php";

    /// <summary>
    /// URL query payment
    /// </summary>
    string PG_url_query = "payment_query.php";

    /// <summary>
    /// URL embed payment
    /// </summary>
    string PG_url_embed = "merchant_popup.php";

    /// <summary>
    /// This merchant code provided by SohaPay
    /// </summary>
    string Merchant_site_code = "u189";

    /// <summary>
    /// This Secure secret provided by SohaPay
    /// </summary>
    string Secure_secret = "12345678";

    public SohaPayment()
    {
        PG_url = PG_ROOT_URL + PG_url;
        PG_url_query = PG_ROOT_URL + PG_url_query;
        PG_url_embed = PG_ROOT_URL + PG_url_embed;
    }

    public SohaPayment(string site_code, string site_secret)
    {
        Merchant_site_code = site_code;
        Secure_secret = site_secret;

        PG_url = PG_ROOT_URL + PG_url;
        PG_url_query = PG_ROOT_URL + PG_url_query;
        PG_url_embed = PG_ROOT_URL + PG_url_embed;
    }

    /// <summary>
    /// Method build url checkout payment
    /// </summary>
    /// <param name="returnUrl">Url called return from SohaPay</param>
    /// <param name="orderCode">Order Code</param>
    /// <param name="orderPrice">Price</param>
    /// <param name="orderEmail">Email</param>
    /// <param name="orderMobile">Mobile</param>
    /// <param name="orderDescription">Detail description about order</param>
    /// <returns></returns>
    public string BuildCheckoutUrl(string returnUrl, string orderTitle, string orderCode, long orderPrice, string orderEmail, string orderMobile, string orderDescription)
    {
        // Param value send to SohaPay
        Hashtable arrparam = new Hashtable();
        arrparam["site_code"] = Merchant_site_code;
        arrparam["return_url"] = returnUrl;
        arrparam["transaction_info"] = orderDescription;
        arrparam["order_code"] = orderCode;
        arrparam["price"] = orderPrice.ToString();
        arrparam["order_email"] = orderEmail;
        arrparam["order_mobile"] = orderMobile;
        arrparam["order_product_title"] = orderTitle;
        arrparam["version"] = "2";

        // Step 2 : check redirect url have exists '?'
        string redirectUrl = PG_url;
        if (redirectUrl.LastIndexOf("?") == -1)
        {
            redirectUrl += "?";
        }
        else if (redirectUrl.Substring(returnUrl.Length - 1, 1) != "?" && redirectUrl.LastIndexOf("&") == -1)
        {
            redirectUrl += "&";
        }

        // Step 3 : make url
        ArrayList keys = new ArrayList();
        keys.AddRange(arrparam.Keys);
        keys.Sort();

        List<string> param = new List<string>();
        string secure_code = "";
        foreach (string k in keys)
        {
            if (arrparam[k].ToString().Length == 0) continue;

            param.Add(HttpContext.Current.Server.UrlEncode(k) + "=" + HttpContext.Current.Server.UrlEncode(arrparam[k].ToString()));
            secure_code += k + "=" + arrparam[k].ToString() + "&";
        }
        redirectUrl += string.Join("&", param.ToArray());

        secure_code = secure_code.TrimEnd('&');
        if (secure_code.Length > 0)
        {
            var hmacsha256 = new HMACSHA256(Encoding.UTF8.GetBytes(Secure_secret));


            redirectUrl += "&secure_hash=" + CreateSHA256Signature(Secure_secret, secure_code).ToUpper();

        }
        return redirectUrl;
    }

    public bool VerifyReturnUrl()
    {
        string secure_hash = HttpContext.Current.Request["secure_code"];
        Hashtable param = new Hashtable();
        param["order_product_title"] = !string.IsNullOrEmpty(HttpContext.Current.Request["order_product_title"]) ? HttpContext.Current.Request["order_product_title"] : "";
        param["transaction_info"] = !string.IsNullOrEmpty(HttpContext.Current.Request["transaction_info"]) ? HttpContext.Current.Request["transaction_info"] : "";
        param["order_code"] = !string.IsNullOrEmpty(HttpContext.Current.Request["order_code"]) ? HttpContext.Current.Request["order_code"] : "";
        param["order_email"] = !string.IsNullOrEmpty(HttpContext.Current.Request["order_email"]) ? HttpContext.Current.Request["order_email"] : "";
        param["order_session"] = !string.IsNullOrEmpty(HttpContext.Current.Request["order_session"]) ? HttpContext.Current.Request["order_session"] : "";
        param["price"] = !string.IsNullOrEmpty(HttpContext.Current.Request["price"]) ? HttpContext.Current.Request["price"] : "";
        param["site_code"] = !string.IsNullOrEmpty(HttpContext.Current.Request["site_code"]) ? HttpContext.Current.Request["site_code"] : "";
        param["response_code"] = !string.IsNullOrEmpty(HttpContext.Current.Request["response_code"]) ? HttpContext.Current.Request["response_code"] : "";
        param["response_message"] = !string.IsNullOrEmpty(HttpContext.Current.Request["response_message"]) ? HttpContext.Current.Request["response_message"] : "";
        param["payment_type"] = !string.IsNullOrEmpty(HttpContext.Current.Request["payment_type"]) ? HttpContext.Current.Request["payment_type"] : "";
        param["payment_time"] = !string.IsNullOrEmpty(HttpContext.Current.Request["payment_time"]) ? HttpContext.Current.Request["payment_time"] : "";
        param["error_text"] = !string.IsNullOrEmpty(HttpContext.Current.Request["error_text"]) ? HttpContext.Current.Request[""] : "error_text";

        param = Sort(param);

        string shaData = "";
        foreach (DictionaryEntry d in param)
        {
            if (d.Key.ToString() != "secure_code" && d.Value.ToString().Length > 0)
            {
                shaData += d.Key.ToString() + "=" + d.Value.ToString() + "&";
            }
        }
        shaData = shaData.TrimEnd('&');

        if (secure_hash.ToUpper() == CreateSHA256Signature(Secure_secret, shaData))
        {
            return true;
        }

        return false;
    }

    public string GetResponseDescriptionInternational(string responseCode)
    {
        string result = "";
        switch (responseCode)
        {
            case "0": result = "Successful transactions"; break;
            case "?": result = "Transaction status unknown"; break;
            case "1": result = "Unknown error"; break;
            case "2": result = "Bank transactions is refuse"; break;
            case "3": result = "No response from Bank"; break;
            case "4": result = "Card expires"; break;
            case "5": result = "The balance is not enough to pay"; break;
            case "6": result = "Error communicating with the Bank"; break;
            case "7": result = "Error Payment System server"; break;
            case "8": result = "Transaction type is not supported"; break;
            case "9": result = "Bank transactions declined (no relation to the Bank)"; break;
            case "A": result = "Transaction Aborted"; break;
            case "B": result = "Blocked due to fraud risk"; break;
            case "C": result = "transaction is canceled"; break;
            case "D": result = "transaction has been deferred pending receipt"; break;
            case "E": result = "Referred"; break;
            case "F": result = "3D Secure xác thực không thành công"; break;
            case "I": result = "Card Security Code verification fails"; break;
            case "L": result = "Procurement transaction is closed (Please try again in a transaction)"; break;
            case "N": result = "Cardholder not enrolled in the program authentication"; break;
            case "P": result = "transactions have been received by the Payment Adaptor and is being processed"; break;
            case "R": result = "transaction was not handled - has reached the limit of retry attempts allowed"; break;
            case "S": result = "SessionID duplicate (OrderInfo)"; break;
            case "T": result = "Address verification is not correct"; break;
            case "U": result = "Card Security Code is not correct"; break;
            case "V": result = "Address Verification and Card Security Code is incorrect"; break;
            case "9999": result = "Transaction fraud risk"; break;
            case "9998": result = "Transaction fraud risk, to authenticate the cardholder"; break;
            case "PG": result = "Transaction does not exist on the system"; break;
            default: result = "Unable to determine"; break;
        }
        return result;
    }

    public string GetResponseDescriptionDomestic(string responseCode)
    {
        string result = "";
        switch (responseCode)
        {
            case "0": result = "Successful transactions"; break;
            case "1": result = "Bank rejected transactions"; break;
            case "3": result = "Unit code does not exist"; break;
            case "4": result = "Không đúng access code"; break;
            case "5": result = "The amount is invalid"; break;
            case "6": result = "Currency code does not exist"; break;
            case "7": result = "Unknown error"; break;
            case "8": result = "Incorrect card number"; break;
            case "9": result = "Tên chủ thẻ không đúng"; break;
            case "10": result = "Card expiration / card locked"; break;
            case "11": result = "Unregistered card using the online payment service."; break;
            case "12": result = "Release date / expired variance"; break;
            case "13": result = "Exceed the payment limits"; break;
            case "21": result = "The balance is not enough to pay"; break;
            case "99": result = "The user canceled the transaction"; break;
            case "100": result = "Do not enter card information / Cancel payment transaction"; break;
            case "PG": result = "Transaction does not exist on the system"; break;
            default: result = "Unable to determine"; break;
        }
        return result;
    }

    public string getResponseDescriptionMobileCard(string responseCode)
    {
        string result = "";
        switch (responseCode)
        {
            case "1": result = "Successful transactions"; break;
            case "-1": result = "Card used"; break;
            case "-2": result = "Card blocked"; break;
            case "-3": result = "Card has expired"; break;
            case "-4": result = "Card not activated"; break;
            case "-10": result = "Card number is not valid"; break;
            case "-11": result = "Card number is not valid"; break;
            case "-12": result = "Card does not exist"; break;
            case "-99": result = "System Error"; break;
            case "0": result = "Other Error"; break;
            case "2": result = "No login functions using charge"; break;
            case "3": result = "Error VDCO system"; break;
            case "4": result = "Card can not be used (common error Vinaphone)"; break;
            case "5": result = "Make the wrong 5 times in a row"; break;
            case "6": result = "Performs the logout fails"; break;
            case "8": result = "Charge card faulty system. This error needs for control and control"; break;
            case "9": result = "Partner information is incorrect"; break;
            case "10": result = "False information email or mobile format"; break;
            default: result = "Unable to determine"; break;
        }
        return result;
    }

    Hashtable Sort(Hashtable table)
    {
        ArrayList keys = new ArrayList();
        keys.AddRange(table.Keys);
        keys.Sort();

        Hashtable tmp = new Hashtable();
        foreach (string k in keys)
        {
            tmp[k] = table[k];
        }
        return tmp;
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
}
