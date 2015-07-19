import java.applet.*;  
import java.awt.*;  
import java.util.*;  
import java.text.*;  
  
public class clock extends Applet implements Runnable {  
  
   Thread t = null;  
   int hours=0, minutes=0, seconds=0;  
   String timeString = "";  
  
   public void init() {  
      setBackground( Color.black);  
   }  
  
   public void start() {  
        t = new Thread( this );  
        t.start();  
   }  
  
    
   public void run() {  
      try {  
         while (true) {  
  
            Calendar cal = Calendar.getInstance();  
            hours = cal.get( Calendar.HOUR_OF_DAY );  
            if ( hours > 12 ) hours -= 12;  
            minutes = cal.get( Calendar.MINUTE );  
            seconds = cal.get( Calendar.SECOND );  
  
            SimpleDateFormat formatter = new SimpleDateFormat("hh:mm:ss");  
            Date date = cal.getTime();  
            timeString = formatter.format( date );  
  
            repaint();  
            t.sleep( 1000 );   
         }  
      }  
      catch (Exception e) { }  
   }  
  
    
  public void paint( Graphics g ) {
	  Font font = new Font("Arial",Font.BOLD,30);
	  g.setFont(font);
      g.setColor( Color.blue );  
      g.drawString( timeString, 0, 35 );  
   }  
}

//<applet code="clock.java" width="150" height="50"> </applet>
