using UnityEngine;
using UnityEditor;
using System.Collections;
using System.IO;

public class ObjectReplacement : EditorWindow {
	
	
	Transform Replacer;

	[MenuItem ("Tools/Object Replacement")]
	static void Init () {
		ObjectReplacement window = (ObjectReplacement)EditorWindow.GetWindow (typeof (ObjectReplacement));
		window.Show ();
//		window.Prepare();
	}
	
	
	void OnGUI () {
		GUILayout.Space (10);
		Replacer = EditorGUILayout.ObjectField ("Replacer", Replacer, typeof (Transform), true) as Transform;
		
		GUILayout.Space (10);
		if (GUILayout.Button ("Replacement", GUILayout.MaxWidth (200))) {
			 Replace();
		}
	}
	
	void Replace () {
		if(Replacer == null)
		{
			return;
		}
		Transform[] selectedGameObject = Selection.transforms;
		
		Undo.RegisterSceneUndo("ReplaceMent Object");
		foreach(Transform go in selectedGameObject)
		{
			
			GameObject newobj =  PrefabUtility.InstantiatePrefab(Replacer.gameObject) as GameObject;
			newobj.transform.parent = go.parent;
			
			newobj.transform.localRotation = go.localRotation;
			newobj.transform.localPosition = go.localPosition;
			newobj.transform.localScale = go.localScale;
		}
		
		foreach(Transform go in selectedGameObject)
		{
			DestroyImmediate(go.gameObject);	
		}
	}
}
