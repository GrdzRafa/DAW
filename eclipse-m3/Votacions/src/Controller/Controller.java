package src.Controller;

import java.util.List;

import com.db4o.ObjectContainer;
import com.db4o.ObjectSet;

import src.Model.DBModel;
import src.Model.Municipi;
import src.Model.Partit;
import src.Model.ResultatEleccions;
import src.View.FileSelectorView;

public class Controller {
	public static void main(String[] args) {
        FileSelectorView frame = new FileSelectorView();
        frame.setVisible(true);
	}
}
