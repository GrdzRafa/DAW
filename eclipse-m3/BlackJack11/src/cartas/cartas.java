package cartas;

import java.io.File;
import java.util.ArrayList;

public class cartas {
	private String src;

	public static String[] listFiles(String directoryPath) {
		
		ArrayList<String> fileNames = new ArrayList<>();
		
		File directory = new File(directoryPath);
		
		File[] files = directory.listFiles();

		for (File file : files) {
			if (file.isFile()) {
				fileNames.add(file.getName());
			}
		}

		return fileNames.toArray(new String[0]);
	}
}
