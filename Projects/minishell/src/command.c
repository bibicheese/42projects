/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   command.c                                          :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <marvin@42.fr>                    +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/09/12 14:45:02 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/27 18:20:02 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

char	*find_cmd(t_shell *shell, char *cmd)
{
	int				i;
	int				br;
	char			*path;
	char			*tmp;

	i = 0;
	br = 0;
	if (!(shell->paths))
		return (ft_strdup(cmd));
	while (shell->paths[i])
	{
		tmp = ft_strjoin(shell->paths[i], cmd);
		if (!access(tmp, F_OK) && !access(tmp, X_OK))
		{
			ft_memdel((void **)&tmp);
			break ;
		}
		i++;
		ft_memdel((void **)&tmp);
	}
	if (shell->paths[i])
		path = ft_strjoin(shell->paths[i], cmd);
	else
		return (cmd ? ft_strdup(cmd) : NULL);
	return (path);
}

int		cmd_exist(char *cmd)
{
	if (!access(cmd, F_OK) && !access(cmd, X_OK))
		return (1);
	return (0);
}

int		check_line(char *line)
{
	int		i;

	i = 0;
	while (line[i])
	{
		if (line[i] != ' ' && line[i] != '\t')
			return (1);
		i++;
	}
	return (0);
}
