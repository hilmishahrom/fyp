import processing.serial.*;
int lf=10;
int value;
String myString = null;
String finalString = null;
String rfid = null;
Serial myPort;
int clk=0;
JSONObject json;
void setup() {
  size(700, 300);
  myPort = new Serial(this, Serial.list()[2], 9600);
  myPort.clear();
  myString = myPort.readStringUntil(lf);
  myString = null;
  userForm();
}
void draw() {
  
 //getting data from serial port when data coming
  while (myPort.available()>0) {
    myString = myPort.readStringUntil(lf);
    if (myString!=null) {
      myString = trim(myString);
    }
    //smooth();
  }

    if (myString !=null) {
      String []myStringAr = split(myString, " ");
       rfid = join(myStringAr, "");
       boolean chkFlag = checkUIDAlreadyExists(rfid);
    }
    
  myString = null;
}
boolean checkUIDAlreadyExists(String rfid) {
  boolean bool=false;;
  String param="method=checkUIDAlreadyExists&uid="+rfid;
  String url = "http://192.168.64.2/attendanceSystem/callApi.php?"+param;
  String retMsg = null;
  try {
    String[] chkStrRespAr = loadStrings(url);
    
      retMsg = chkStrRespAr[0];
      if(retMsg.equals("1")){
        
        lbl_error_success_msg.setLabel("This card is not registered!");
        println("Card Not Exists!");
      }else if(retMsg.equals("0")){
        
        //Showing Add button and UID LABEL
        bool=true;
        lbl_uid.setPosition(120, 130);
        lbl_uid.setLabel(rfid);
        
        //ADDING BUTTON
        c.add(btn_addUser);
      }else{
        //SETTING MSG LABEL
        lbl_error_success_msg.setLabel("Invalid Card UID Provided!");
      }
  }
  catch(Exception e) {
    println("Something Unexpected Happened Please try after Sometime!");
  }
  delay(1000);
  return bool;
  
}
void addUser(){
  String param="viewid="+rfid;
  //String url = "http://192.168.64.2/attendanceSystem/view-normal-ticket.php?"+param;
  
  //String[] chkStrRespAr = loadStrings(url);
  link("http://192.168.64.2/ptms/view-monthly-ticket.php?"+param);
  
}
