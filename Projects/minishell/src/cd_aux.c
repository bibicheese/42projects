/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   cd_aux.c                                           :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/19 15:02:40 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/23 15:07:24 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

char			**newpwd(char *oldpwd, char *pwd)
{
	char	**env;

	if (!(env = (char **)malloc(sizeof(char *) * 3)))
		return (NULL);
	env[0] = ft_strjoin("PWD=", pwd);
	env[1] = ft_strjoin("OLDPWD=", oldpwd);
	env[2] = NULL;
	return (env);
}

static char		*old_or_current(char *str, char *pwd, char *oldpwd)
{
	if (!ft_strcmp(str, "OLDPWD"))
		return (ft_strjoin("OLDPWD=", oldpwd));
	else
		return (ft_strjoin("PWD=", pwd));
}

static int		no_pwd(t_shell *shell)
{
	int		check;
	int		i;

	i = -1;
	check = 1;
	while (shell->lenv[++i])
	{
		if (!ft_strcmp(shell->lenv[i], "PWD"))
			check = 0;
	}
	return (check);
}

static int		no_oldpwd(t_shell *shell)
{
	int		check;
	int		i;

	i = -1;
	check = 1;
	while (shell->lenv[++i])
	{
		if (!ft_strcmp(shell->lenv[i], "OLDPWD"))
			check = 0;
	}
	return (check);
}

char			**replacepwd(t_shell *shell, char *oldpwd, char *pwd)
{
	char	**newenv;
	int		i;
	int		add;

	if (!(newenv = (char **)malloc(sizeof(char *)
		* (ft_arrlen(shell->env) + 2))))
		return (NULL);
	i = -1;
	add = 1;
	while (shell->env[++i])
	{
		if (!ft_strcmp(shell->lenv[i], "PWD") ||
			!ft_strcmp(shell->lenv[i], "OLDPWD"))
			newenv[i] = old_or_current(shell->lenv[i], pwd, oldpwd);
		else
			newenv[i] = ft_strdup(shell->env[i]);
	}
	if (no_pwd(shell))
		newenv[i++] = ft_strjoin("PWD=", pwd);
	if (no_oldpwd(shell))
		newenv[i++] = ft_strjoin("OLDPWD=", oldpwd);
	newenv[i] = NULL;
	return (newenv);
}
