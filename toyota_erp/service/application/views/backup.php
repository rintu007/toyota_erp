<div class="container border" style="width: 948px;">
<div style="text-align:center; font-style:bold;"><h4>REPAIR ORDER/BILL</h4></div>
  <div class="header" style="background:none;">
    <div class="left">
      <div class="logo"> <img src="<?= base_url(); ?>assets/images/toyota-logo.PNG" style="width: 150px;"> </div>
    </div>
    <div class="center" style="height: 96px;width: 540px; border-right: none;"
      <h3>TOYOTA WESTERN MOTORS</h3>
      <p>C-38, Estate Avenue, S.I.T.E Karachi, Pakistan. Post Code-75730 <br>
        Tel : (021) 111-888-788, 32564531-5 Fax : (021) 32587669, 32564536 <br>
        E-mail : twm_services@yahoo.com</p>
    </div>
    <div class="right" style=" margin-right:23px;">
      <div class="logo"> <img src="<?= base_url(); ?>assets/images/daihaisu-logo.PNG" style="height: 42px; width:189px;"><br>
        <div class="rono"> <span>R. O. # _______________</span> </div>
      </div>
    </div>
  </div>
  <!--header end-->
  
  <div class="col-sm-9 p-l">
    <table class="table" style="width: 615px;">
      <tbody>
        <tr>
				  <td style=" padding-top: 2px !important;padding-bottom: 3px !important; width: 157px;">CUSTOMER'S NAME : </td>
          <td colspan="3" style="padding-top: 2px !important;padding-bottom: 3px !important; width: 157px;"><?= $getRoData[0]['CustomerName']?></td>
        </tr>
        <tr>
          <td style="padding-top: 2px !important;padding-bottom: 3px !important; width: 157px;">ADDRESS : </td>
          <td colspan="3" style="padding-top: 2px !important;padding-bottom: 3px !important; width: 157px;"><?= $getRoData[0]['AddressDetails']?></td>
        </tr>
        <tr>
          <td colspan="3"style="padding: -3px;padding-top: 2px !important;padding-bottom: 3px !important; ">&nbsp;</td>
        </tr>
        <tr>
          <td class="td-w b-b" style="padding-top: 2px !important;padding-bottom: 3px !important; width: 157px;">NTN/NIC : </td>
          <td class="b-b" style="padding-top: 2px !important;padding-bottom: 3px !important; width: 238px;"><?= $getRoData[0]['Cnic'] ?> &nbsp; <?= $getRoData[0]['Ntn'] ?></td>
          <td style="padding-top: 2px !important;padding-bottom: 3px !important; "class="b-b">TEL : </td>
          <td class="b-b"style="padding-top: 2px !important;padding-bottom: 3px !important; "><?= $getRoData[0]['Ntn'] ?></td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="col-sm-3 p-r">
    <div class="table-responsive table-border">
      <table class="table">
        <tr>
          <td align="center" colspan="2" style="border-right: 1px solid #dfdfdf;">CASH MEMO NO.</td>
          <td align="center" style="border-right: 1px solid #dfdfdf;">CREDIT MEMO</td>
        </tr>
        <tr>
          <td align="center" colspan="2" style="border-right: 1px solid #dfdfdf;">BOOK IN <br>
            <span style="float: left;    padding-left: 10px;">DATE</span> <span style="float: right; padding-right: 10px;">TIME</span></td>
          <td align="center" colspan="2" style="border-right: 1px solid #dfdfdf;">DELIVERY IN <br>
            <span style="float: left;    padding-left: 10px;">DATE</span> <span style="float: right; padding-right: 10px;">TIME</span></td>
        </tr>
        <tr>
          <td class="b-b b-r">&nbsp;</td>
          <td class="b-b b-r">&nbsp;</td>
          <td class="b-b b-r">&nbsp;</td>
        </tr>
      </table>
    </div>
  </div>
  <div class="table-border">
    <table class="table">
      <tbody>
        <tr>
          <td align="center" colspan="2" style="border-right: 1px solid #dfdfdf;">MAKE</td>
          <td align="center" style="border-right: 1px solid #dfdfdf;">MODEL</td>
          <td align="center" style="border-right: 1px solid #dfdfdf;">REG. NO.</td>
          <td align="center" style="border-right: 1px solid #dfdfdf;">KM</td>
          <td align="center" style="border-right: 1px solid #dfdfdf;">FRAME NO.</td>
          <td align="center" style="border-right: 1px solid #dfdfdf;">ENGINE NO.</td>
          <td align="center" style="border-right: 1px solid #dfdfdf;">FUEL <br>
            E &nbsp;&nbsp;&nbsp; <sup>1</sup>/2 &nbsp;&nbsp;&nbsp; F</td>
          <td align="center" style="border-right: 1px solid #dfdfdf; border-bottom:1px solid #dfdfdf;">GATE PASS NO.</td>
        </tr>
        <tr align="center">
          <td colspan="3" class="b-btm">IMAGE</td>
          <td class="b-r b-l b-b">INSURANCE</td>
          <td style="border-right: 1px solid #dfdfdf;">INTERNAL</td>
          <td style="border-right: 1px solid #dfdfdf;">CUSTOMER</td>
          <td style="border-right: 1px solid #dfdfdf;">WARRANTY</td>
          <td style="border-right: 1px solid #dfdfdf;">OTHER</td>
          <td>CASH/CREDIT<br>
            CHEQUE</td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" align="center" class="b-l"><strong>MECHANICAL REPAIRS</strong></td>
          <td colspan="3" align="center" class="b-l"><strong>BODY / PAINT</strong></td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">1. </span> WASH AND LUBRICATION <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l" width="50%"><label>SERVICES<br>
              <input type="text" class="input-width">
            </label>
            <label>UNDERCOAT<br>
              <input type="text" class="input-width">
            </label>
            <label>W/BALANCE<br>
              <input type="text" class="input-width">
            </label>
            <label>W/ALIGNMENT<br>
              <input type="text" class="input-width">
            </label></td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">2. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">1. </span> OIL CHANGE ENG. / GEAR / DIFF</td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">3. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">2. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right" style="margin-right:10px;">
            <input type="text" class="group-input-w">
            <input type="text" class="group-input-w">
            <input type="text" class="group-input-w">
            <input type="text" class="group-input-w">
            </span></td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">4. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">3. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">5. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">4. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">6. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">5. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">7. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">6. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3" class="b-btm">&nbsp;</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">8. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">7. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3" align="center"><strong>CHECK LIST</strong></td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">9. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">8. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3">RADIO / ANTENNAE</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">10. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">9. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3">CASSTTEE PLAYER</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">11. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">10. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
          <td colspan="3">CASSETTES - USB</td>
          <td colspan="3" class="b-l td-pd"><span class="m-r">12. </span> OIL CHANGE ENG. / GEAR / DIFF <span class="pull-right">
            <input type="checkbox" name="number">
            </span></td>
          <td colspan="3" class="b-l"><span class="m-r">11. </span> OIL CHANGE ENG. / GEAR / DIFF </td>
        </tr>
        <tr>
        <td colspan="5">&nbsp;</td>
        <td align="center" class="b-r">JOB REQUEST / V.O.C</td>
        <td align="center" colspan="3">WORK ORDER ATTACH</td>
        </tr>
        <tr>
        <td colspan="8" class="b-r">&nbsp;</td>
        <td class=""><label>YES<br>
              <input type="text" class="input-width">
            </label> <label>NO<br>
              <input type="text" class="input-width">
            </label></td>
        </tr>
        <tr>
        <td colspan="8" class="b-r">&nbsp;</td>
        <td class="b-btm">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="8" class="b-r">&nbsp;</td>
        <td class="b-btm">&nbsp;</td>
        </tr>
        <tr>
        <td colspan="8" class="b-r">&nbsp;</td>
        <td class="">&nbsp;</td>
        </tr>
        
        
        <tr class="b-b">
        <td colspan="8" class="b-r">&nbsp;</td>
        <td style="padding:0px !important;">
        <table class="table" style="margin-bottom:0px !important;">
        <tr>
        <td style="border-top:0px !important; text-align:center;" class="b-r b-b">HRS</td>
        <td style="border-top:0px !important; text-align:center;" class="b-b">AMOUNT</td>
        </tr>
        
        <tr>
        <td style="border-top:0px !important; text-align:center;" class="b-r">&nbsp;</td>
        <td style="border-top:0px !important; text-align:center;">&nbsp;</td>
        </tr>
        
        
        </table>
        </td>
        </tr>
        
   </tbody>
    </table>
    
  	<table class="table">
    <tr>
    <td width="35%" class="b-btm">THE ABOVE WORK HERBY AUTHOORISED AND TERMS AGREED TO AS PUT LINED OVERLEAF.</td>
	<td class="b-l b-btm">&nbsp;</td>
    <td class="b-l b-btm">&nbsp;</td>
    <td class="b-l">LABOUR</td>
    <td class="b-l">Empty</td>
    </tr>
    
    <tr>
    <td width="35%" class="b-btm">CUSTOMER'S SIGNATURE _____________________</td>
	<td class="b-l b-btm">&nbsp;</td>
    <td class="b-l b-btm">&nbsp;</td>
    <td class="b-l">LUB OIL</td>
    <td class="b-l">Empty</td>
    </tr>
    
    <tr>
    <td width="35%">CUSTOMER'S NAME __________________________</td>
    <td class="b-l" style="text-decoration: overline; text-align:center;">SERVICE ADVISOR</td>
    <td class="b-l" style="text-decoration: overline; text-align:center;">RECOVERY OFFICER</td>
    <td class="b-l" colspan="">SUBLEFT REPAIR</td>
    <td class="b-l">Empty</td>
    </tr>
    
    
    <tr>
    <td width="35%" class="b-btm">RECEIVED THE CAR ALONG WITH ALL TOOLS AND ACCESSORIES. THE REPAIRS HAVE BEEN PERFORMED TO MY SATISFACTION.</td>
	<td class="b-l b-btm" colspan="2">&nbsp;</td>
    <td class="b-l">PARTS</td>
    <td class="b-l">Empty</td>
    </tr>
    
    <tr>
    <td width="35%" class="b-btm">CUSTOMER'S SIGNATURE _____________________</td>
	<td class="b-l b-btm" colspan="2">&nbsp;</td>
    <td class="b-l">GRAND TOTAL</td>
    <td class="b-l">Empty</td>
    </tr>
    
    <tr>
    <td width="35%" class="b-btm">CUSTOMER'S NAME __________________________</td>
    <td class="b-btm b-l">&nbsp;</td>
    <td class="b-btm">&nbsp;</td>
    <td class="b-l" colspan="">G.S.T @ 16%</td>
    <td class="b-l">Empty</td>
    </tr>
    
    <tr>
    <td width="35%" class="b-b">&nbsp;</td>
    <td class="b-b b-l" colspan="2" style="text-decoration: overline; text-align:center;">SERVICE ADVISOR</td>
    <td class="b-l b-b" colspan="">NEW TOTAL</td>
    <td class="b-l b-b">Empty</td>
    </tr>
    
    
    
    </table>
  </div>
</div>