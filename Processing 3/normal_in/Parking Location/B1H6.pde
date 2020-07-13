import processing.serial.*;

int lf=10;
int value;
String myString = null;
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
  if(clk<=0){
    if (myString !=null) {
      String []myStringAr = split(myString, " ");
      String finalString = "method=getNormal_in_useApi&loc_id=B1H6&uid="+join(myStringAr, "");
      validateUser(finalString);
    }
  }else{
    
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
void validateUser(String uid) {
  delay(1000);
  if (uid!=null) {
    uid = trim(uid);

    // finalUid = finalUid+"A";
    //println(uid);
    String param="method=checkUIDAlreadyExistss&uid="+uid;
    String url = "http://192.168.64.2/attendanceSystem/callApi.php?"+param;
    String retMsg = null;
    String urls = "http://192.168.64.2/attendanceSystem/callApi.php?"+uid;
    //println(url);
    try {
      String[] chkStrRespAr = loadStrings(url);
        retMsg = chkStrRespAr[0];
        if(retMsg.equals("0")){
          println("You are parked at B1, lot number H6.");
          try {
            String[] lines = loadStrings(urls);

            //println("there are " + lines.length + " lines");
            for (int i = 0; i < lines.length; i++) {
              println(lines[i]);
            }
            
          }
          catch(Exception e) {
            println("Something Unexpected Happened Please try after Sometime!");
          }
    //println(lines);
        }else if(retMsg.equals("1")){
          println("Card not registered!");
        }else{
          println("Card invalid!");
        }
    }catch(Exception e){
      println("Invalid!");    
    }
  }
}
