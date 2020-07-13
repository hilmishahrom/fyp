import processing.serial.*;

int lf=10;
int value;
String myString = null;
String rfid = null;
Serial myPort;

Button on_button;  // the button
int clk=0;
void setup() {
  size(200, 200);
  myPort = new Serial(this, Serial.list()[2], 9600);
  myPort.clear();
  myString = myPort.readStringUntil(lf);
  myString = null;

  //creating button class object to add UID
 // on_button = new Button("Add UID", 10, 10, 70, 30);
 // on_button.addUserBtn();
}
void draw() {
  //getting data from serial port when data coming
  while (myPort.available()>0) {
    myString = myPort.readStringUntil(lf);
    if (myString!=null) {
      myString = trim(myString);
    }
    smooth();
  }
  //if string is not null
    if (myString !=null) {
      String []myStringAr = split(myString, " ");
       rfid = join(myStringAr, "");
       checkUIDAlreadyExists(rfid);
    }
  myString = null;
  // draw the button in the window
  
}
// mouse button clicked
void mousePressed()
{
  if (on_button.MouseIsOver()) {
    // print some text to the console pane if the button is clicked
    print("User addition mode is on to stop press stop");
    if(clk==1)
    on_button.stopBtn();
    println(clk++);
  }
}
//call to check wheater uid user is valid or not 
void checkUIDAlreadyExists(String rfid) {
  String param="method=checkUIDAlreadyExistss&uid="+rfid;
  String url = "http://192.168.64.2/attendanceSystem/callApi.php?"+param;
  String retMsg = null;
  try {
    String[] chkStrRespAr = loadStrings(url);
    
      retMsg = chkStrRespAr[0];
      if(retMsg.equals("0")){
        myPort.write('1');
        println("Welcome!");
      }else if(retMsg.equals("1")){
        println("Card not registered!");
      }else{
        //SETTING MSG LABEL
        println("Invalid Card Provided!");
      }
  }
  catch(Exception e) {
    println("Something Unexpected Happened Please try after Sometime!");
  }
  delay(1000);
  
} 
